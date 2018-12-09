<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cabang_Olahraga;
use App\Nomor_Pertandingan;
use App\Master_Atlet;
use App\Event;
use App\Detail_Event;
use Datatables;
use DB;
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
        $query = Master_Atlet::where('cabor_id',$request->id_cabor);
        if($request->jenis_kelamin != "S")
            $query->where('jenis_kelamin',$request->jenis_kelamin);

        $data['content'] = $query->select($colomSelect)->get();
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
       $query = Detail_Event::where('event_id',$request->id_event)
                ->leftJoin('cabang_olahraga','cabor_id','=','id_cabor')
                ->select('id_cabor as id','nama_cabor as text')
                ->get();

        return \Response::json($query);
    }
}
