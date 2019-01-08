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
use App\Juara;
use App\Medali;
use App\Tingkat_Event;

class PrestasiController extends Controller
{
    public function index(){
    	$data['page'] = "Prestasi";
    	$data['active'] = "Prestasi";

    	return view('Prestasi.Prestasi',$data);
    }

    public function getData(){
    	$data = Prestasi::select('nama_atlet','ket_juara','ket_np','nama_cabor','id_prestasi','nama_medali')
    		->leftJoin('cabang_olahraga','id_cabor','=','cabor_id')
    		->leftJoin('master_atlet','id_atlet','=','atlet_id')    		
    		->leftJoin('nomor_pertandingan','id_np','=','np_id')
            ->leftJoin('juara','juara_id','=','id_juara')
            ->leftJoin('medali','medali_id','=','id_medali')            
	        ->get();


	        

      return Datatables::of($data)
      ->addColumn('aksi', function($data){
      	return "<button onclick='view(".$data->id_prestasi.")' class='btn btn-xs btn-warning'> <i class='fa fa-eye'> </i> View </button>
      		<a href=".route('editPrestasi',$data->id_prestasi)."><button class='btn btn-xs btn-primary'> <i class='fa fa-edit'> </i> Edit  </button> </a>
      		<button onclick='hapus(\"".$data->nama_atlet."\",".$data->id_prestasi.")' class='btn btn-xs btn-danger'> <i class='fa fa-trash'> </i> Hapus  </button>";
      })

      ->make(true);
    }

    public function getDetail(Request $Request){
    	$data = Prestasi::select('nama_atlet','ket_juara','ket_np','nama_cabor','id_prestasi','waktu','nama_event','nama_tingkat','nama_medali')
            ->leftJoin('medali','medali_id','=','id_medali')            
            ->leftJoin('juara','juara_id','=','id_juara')
    		->leftJoin('cabang_olahraga','id_cabor','=','cabor_id')
    		->leftJoin('master_atlet','id_atlet','=','atlet_id') 
    		->leftJoin('nomor_pertandingan','id_np','=','np_id')
    		->leftJoin('event','id_event','=','event_id')
            ->leftJoin('tingkat_event','id_tingkat','=','tingkat_id')
    		->where('id_prestasi',$Request->id)
	        ->first();

	    echo json_encode($data);
    }

    public function tambah(){
    	$data['page'] = "Tambah Prestasi";
    	$data['active'] = "Prestasi";

        $data['juara'] = Juara::select('*')->get();

        $data['medali'] = Medali::select('*')->get();

    	$data['cabor'] = Cabang_Olahraga::select('nama_cabor','id_cabor')->get();

    	$data['atlet'] = Master_Atlet::select('nama_atlet','id_atlet')
    						->get();

        $data['tingkat_event'] = Tingkat_Event::select('*')->get();

        $data['event'] = Event::select('id_event','nama_event')->get();

    	return view('Prestasi.tambahPrestasi',$data);
    }

    public function edit($id){
    	$data['page'] = "Edit Prestasi";
    	$data['active'] = "Prestasi";

        $data['prestasi'] = Prestasi::select('*')
                        ->leftJoin('event','event_id','=','id_event')
                        ->leftJoin('Tingkat_Event','id_tingkat','=','tingkat_id')
                        ->where('id_prestasi',$id)
                        ->first();

        $data['juara'] = Juara::select('*')->get();

        $data['tingkat_event'] = Tingkat_Event::select('*')->get();

        $data['medali'] = Medali::select('*')->get();

        $data['cabor'] = Cabang_Olahraga::select('nama_cabor','id_cabor')->get();

        $data['atlet'] = Master_Atlet::select('nama_atlet','id_atlet','np_id')
                        ->leftJoin('detail_atlet','id_atlet','=','atlet_id')
                        ->where('np_id',$data['prestasi']->np_id)
                        ->get();

        $data['event'] = Event::select('id_event','nama_event')->get();
        $data['np']    = Nomor_Pertandingan::select('id_np','ket_np')->where('cabor_id',$data['prestasi']->cabor_id)->get();
        

        //dd($data['medali']);

        return view('Prestasi.editPrestasi',$data);
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
            ->groupBy('id_atlet')
            ->get();

        echo json_encode($data);
    }

    public function getEvent(Request $Request){
        $data = Event::select('id_event','nama_event')            
            ->where('tingkat_id',$Request->id)
            ->get();

        echo json_encode($data);
    }

    public function addPrestasi(Request $Request){
        $data  = new Prestasi();
        $data->id_prestasi      = null;
        $data->atlet_id         = $Request->atlet;
        $data->juara_id         = $Request->juara;
        $data->medali_id        = $Request->medali;
        $data->cabor_id         = $Request->cabor;
        $data->np_id            = $Request->np;        
        $data->event_id         = $Request->event;
        $data->waktu            = $Request->waktu;
        $save = $data->save();
        if($save){
            return redirect()->route('Prestasi')->with(['status' => 'success', 'message' => 'Data berhasil ditambahkan']);
        }
        else{
            return redirect()->route('Prestasi')->with(['status' => 'failed', 'message' => 'Data gagal ditambahkan']);
        }
    }

    public function update(Request $Request){
        $data  = Prestasi::select('*')            
            ->where('id_prestasi',$Request->id_prestasi)
            ->update([
                'juara_id'                 => $Request->juara,
                'medali_id'                => $Request->medali,
                'cabor_id'                 => $Request->cabor,
                'np_id'                    => $Request->np,
                'atlet_id'                 => $Request->atlet,
                'event_id'                 => $Request->event,
                'waktu'                    => $Request->waktu ,
                ]);
        return redirect()->route('Prestasi')->with(['status' => 'success' , 'message' => 'Data berhasil dirubah']);
    }

    public function delete($id){
        $data = Prestasi::select('*')->where('id_prestasi',$id)->first();
        $data->delete();

        return redirect()->route('Prestasi')->with(['status'=> 'success' , 'message' => 'Data berhasil dihapus']);

        
    }    
}
