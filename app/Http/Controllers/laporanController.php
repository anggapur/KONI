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
        $mpdf = new \Mpdf\Mpdf();

        // Write some HTML code:
        
        //$mpdf->defaultheadertextalign='center';
        //$mpdf->setHTMLHeader("Table");
        $mpdf->setTitle("Laporan");
        $table = "<caption> ".$request->judul_table." </caption>";
        $table .= "<table border='1' cellspacing='5' cellpadding='5' style='border-collapse:collapse;width:100%;text-align:center'>";
        $mpdf->WriteHTML($table.$request->data_table."</table>");

        // Output a PDF file directly to the browser
        $mpdf->Output();
    }


}
