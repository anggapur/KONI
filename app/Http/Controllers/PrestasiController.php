<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Prestasi;
use App\Master_Atlet;
use App\Cabang_Olahraga;
use App\Nomor_Pertandingan;
use App\Event;
use App\Detail_Atlet;

class PrestasiController extends Controller
{
    public function index(){
    	$data['page'] = "Prestasi";
    	$data['active'] = "Prestasi";

    	return view('Prestasi.Prestasi',$data);
    }

    public function getData(){
    	$data = Prestasi::select('nama_atlet','nama_prestasi','ket_np','nama_cabor','id_prestasi')
    		->leftJoin('cabang_olahraga','id_cabor','=','cabor_id')
    		->leftJoin('master_atlet','id_atlet','=','atlet_id')    		
    		->leftJoin('nomor_pertandingan','id_np','=','np_id')    		
	        ->get();


	        

      return Datatables::of($data)
      ->addColumn('aksi', function($data){
      	return "<button onclick='view(".$data->id_prestasi.")' class='btn btn-xs btn-warning'> <i class='fa fa-eye'> </i> View </button>
      		<a href=".route('editPrestasi',$data->id_prestasi)."><button class='btn btn-xs btn-primary'> <i class='fa fa-edit'> </i> Edit  </button> </a>
      		<button onclick='hapus(\"".$data->nama_prestasi."\",".$data->id_prestasi.")' class='btn btn-xs btn-danger'> <i class='fa fa-trash'> </i> Hapus  </button>";
      })

      ->make(true);
    }

    public function getDetail(Request $Request){
    	$data = Prestasi::select('nama_atlet','nama_prestasi','ket_np','nama_cabor','id_prestasi','waktu','nama_event')
    		->leftJoin('cabang_olahraga','id_cabor','=','cabor_id')
    		->leftJoin('master_atlet','id_atlet','=','atlet_id')    		
    		->leftJoin('nomor_pertandingan','id_np','=','np_id')
    		->leftJoin('event','id_event','=','event_id')
    		->where('id_prestasi',$Request->id)
	        ->first();

	    echo json_encode($data);
    }

    public function tambah(){
    	$data['page'] = "Tambah Prestasi";
    	$data['active'] = "Prestasi";

    	$data['cabor'] = Cabang_Olahraga::select('nama_cabor','id_cabor')->get();

    	$data['atlet'] = Master_Atlet::select('nama_atlet','id_atlet')
    						->get();

    	return view('Prestasi.tambahPrestasi',$data);
    }

    public function edit($id){
    	$data['page'] = "Edit Prestasi";
    	$data['active'] = "Prestasi";
    }

    public function getNP(Request $Request){
    	$data = Nomor_Pertandingan::select('ket_np','id_np')->where('cabor_id',$Request->id)->get();

    	echo json_encode($data);
    }

    public function getAtlet(Request $Request){
        $data = Master_Atlet::select('id_atlet','nama_atlet')
            ->leftJoin('detail_atlet','id_atlet','=','atlet_id')
            ->leftJoin('nomor_pertandingan','id_np','=','np_id')
            ->where('id_np',$Request->id)
            ->get();

        echo json_encode($data);
    }
}
