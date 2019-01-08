<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cabang_Olahraga;
use App\Nomor_Pertandingan;
use App\Master_Atlet;
use App\Event;
use App\Detail_Event;
use App\Prestasi;
use Datatables;
use DB;
use PDF;
class laporanController extends Controller
{
    //
    public $page = "Cetak Laporan";
    public $viewFolder = "laporan";
    public function index()
    {
        //
        $data['page'] = $this->page;
        $data['cabor'] = Cabang_Olahraga::all();
        $data['nomorPertandingan'] = Nomor_Pertandingan::all();
        $data['atlet'] = Master_Atlet::all();
        $data['event'] = Event::all();
        return view($this->viewFolder.".index",$data);
    }
    public function listDataAtlet(Request $request)
    {
        $colomSelect = [];
        $colomShow = [];
        foreach ($request->colom as $key => $value) {
            array_push($colomSelect,$key);
            array_push($colomShow,$value);
        }
        if($request->id_cabor == 0)
            $query = Master_Atlet::leftJoin('detail_atlet','id_atlet','=','atlet_id');
        else
            $query = Master_Atlet::leftJoin('detail_atlet','id_atlet','=','atlet_id')->where('cabor_id',$request->id_cabor);

        if($request->id_np != 0)
            $query->where('np_id',$request->id_np);

        if($request->jenis_kelamin != "S")
            $query->where('jenis_kelamin',$request->jenis_kelamin);

        $data['content'] = $query->select($colomSelect)->groupBy('id_atlet')->get();
        $data['colomShow'] = $colomShow;
        $data['colomSelect'] = $colomSelect;
        return $data;
    }
    public function rekapJumlahAtlet(Request $request)
    {
        $colomSelect = ["nama_cabor","get_atlet_count"];
        $colomShow = ["Cabang Olahraga","Jumlah Atlet"];
        $caborIdIn = [];
        foreach ($request->colom as $key => $value) {
            array_push($caborIdIn,$key);
        }
        $jk = $request->jenis_kelamin;
        $query = Cabang_Olahraga::whereIn('id_cabor',$caborIdIn)
                    ->withCount(['getAtlet' => function($q) use ($jk){
                        if($jk != "S")
                            $q->where('jenis_kelamin',$jk);
                    }]);
        $data['content'] = $query->get();
        $data['colomShow'] = $colomShow;
        $data['colomSelect'] = $colomSelect;
        return $data;
    }
    public function apiTags(Request $request)
    {
        $id = $request->id_event;
        if($id != 0)
            $query = Detail_Event::where('event_id',$id);
        else
            $query = Detail_Event::where('event_id','!=',$id);

        $query = $query->leftJoin('cabang_olahraga','cabor_id','=','id_cabor')
                ->select('id_cabor as id','nama_cabor as text')
                ->get();

        return \Response::json($query);
    }
    public function listDataPrestasi(Request $request){
        //dd($request);        
        $colomSelect = ["nama_atlet","ket_juara",'nama_medali'];
        $colomShow = ["Nama Atlet","Juara","Medali"];        
        // foreach ($request->colom as $key => $value) {
        //     array_push($caborIdIn,$key);
        // }

        $cabor = $request->cabor_id;
        $event = $request->event_id;
        $np    = $request->np_id;
        $query = Prestasi::select('nama_atlet','ket_juara','nama_medali')
        ->leftJoin('Master_Atlet','id_atlet','=','atlet_id')
        ->leftJoin('juara','id_juara','=','juara_id')
        ->leftJoin('medali','id_medali','=','medali_id');

        if($event != 0)
            $query = $query->where('event_id',$event);
        

        if($np != 0)
            $query = $query->where('np_id',$np);
        


        $query = $query->where('prestasi.cabor_id',$cabor)
        ->get();

        //dd($query);
                    
        $data['content'] = $query;
        $data['colomShow'] = $colomShow;
        $data['colomSelect'] = $colomSelect;
        return $data;   
    }
    public function generate_pdf(request $request) 
    {
        //dd($request->data_table);
        $mpdf = new \Mpdf\Mpdf([
            'mode'=>'utf-8',
            'format' => [210, 297],
            'default_font' => 'Times new Roman'
        ]);
        $mpdf->showImageErrors = true;

        // Write some HTML code:
        $setAutoTopMargin = "stretch";
        $mpdf->setTitle("Laporan");        
        $html = "            
            <table cellpadding='0' cellspacing='0'align='center' style='text-align: center'>
                <tr><td><p></p></td></tr>
                <tr>
                    <td rowspan='7'><img src='public/images/logo_koni.png' height='15%' width='15%' /></td>
                    <td>KOMITE OLAHRAGA NASIONAL INDONESIA</td>
                    <td rowspan='7'><img src='public/images/logo_badung.png' height='15%' width='15%' /></td>
                </tr>
                <tr><td>( KONI )</td></tr>
                <tr><td>KABUPATEN BADUNG</td></tr>
                <tr><td>Sekretariat : Jl.Praja Nomor 5 Kwanji Dalung Badung Telp/Fax.(0361) 4715940</td></tr>
                <tr><td>E-mail :konibadung@yahoo.co.id</td></tr>    
                <tr><td><p></p></td></tr>
            </table>";
        $mpdf->setHeader($html);
        
        $table = "<table> <tr><td><p></p></td></tr> </table>";
        $table .= "<div style='margin-top:150px'><h3 style='text-align:center'>".$request->judul_table."</h3><table border='1' cellspacing='5' cellpadding='5' style='border-collapse:collapse;width:100%;text-align:center'>";       
        $mpdf->WriteHTML($table.$request->data_table."</table></div>");
        $mpdf->setFooter('{PAGENO}');

        // Output a PDF file directly to the browser
        $mpdf->Output();
    }


}
