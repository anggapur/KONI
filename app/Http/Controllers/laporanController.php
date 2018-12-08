<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cabang_Olahraga;
use App\Nomor_Pertandingan;
use App\Master_Atlet;
use Datatables;
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
        return view($this->viewFolder.".index",$data);
    }
    public function listDataAtlet(Request $request)
    {
        $query = Master_Atlet::where('cabor_id',$request->id_cabor);
        if($request->jenis_kelamin != "S")
            $query->where('jenis_kelamin',$request->jenis_kelamin);

        return $query->select('no_kartu_tanda_anggota','nama_atlet','jenis_kelamin','cabor_id')->get();
    }
}
