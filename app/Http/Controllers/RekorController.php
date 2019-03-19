<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Rekor_Atlet;
use App\Master_Atlet;
use App\Cabang_Olahraga;
use App\Nomor_Pertandingan;
use App\Event;
use App\Detail_Atlet;
use App\Tingkat_Event;

class RekorController extends Controller
{
    public function index(){
    	$data['active'] = 'Rekor Atlet';
    	$data['page'] = 'Rekor Atlet';

    	return view('rekor.rekor',$data);
    }

    public function getData(){
    	$data = Rekor_Atlet::select('nama_atlet','keterangan_rekor','ket_np','nama_cabor','id_rekor')
    		->leftJoin('cabang_olahraga','id_cabor','=','cabor_id')
    		->leftJoin('master_atlet','id_atlet','=','atlet_id')    		
    		->leftJoin('nomor_pertandingan','id_np','=','np_id')
	        ->get();


	        

      return Datatables::of($data)
      ->addColumn('aksi', function($data){
      	return "<button onclick='view(".$data->id_rekor.")' class='btn btn-xs btn-warning'> <i class='fa fa-eye'> </i> View </button>
      		<a href=".route('editRekor',$data->id_rekor)."><button class='btn btn-xs btn-primary'> <i class='fa fa-edit'> </i> Edit  </button> </a>
      		<button onclick='hapus(\"".$data->nama_atlet."\",".$data->id_rekor.")' class='btn btn-xs btn-danger'> <i class='fa fa-trash'> </i> Hapus  </button>";
      })

      ->make(true);
    }

    public function edit($id){
    	$data['page'] = "Edit Rekor";
    	$data['active'] = "editRekor";

        $data['rekor'] = Rekor_Atlet::select('*')
                        ->leftJoin('event','event_id','=','id_event')
                        ->leftJoin('Tingkat_Event','id_tingkat','=','tingkat_id')
                        ->where('id_rekor',$id)     
                        ->first();

        $data['cabor'] = Cabang_Olahraga::select('nama_cabor','id_cabor')->get();

        $data['atlet'] = Master_Atlet::select('nama_atlet','id_atlet','np_id')
                        ->leftJoin('detail_atlet','id_atlet','=','atlet_id')
                        ->where('np_id',$data['rekor']->np_id)
                        ->get();

        $data['event'] = Event::select('tingkat_id','id_event','nama_event')->where('tingkat_id',$data['rekor']->id_tingkat)->get();

        //dd($data['rekor']);

        $data['tingkat_event'] = Tingkat_Event::select('*')->get();
        
        $data['np']    = Nomor_Pertandingan::select('id_np','ket_np')->where('cabor_id',$data['rekor']->cabor_id)->get();
        

        //dd($data['atlet']);

        return view('rekor.editRekor',$data);
    }

    public function tambah(){
    	$data['active'] = 'Rekor Atlet';
    	$data['page'] = 'Rekor Atlet';

    	$data['cabor'] = Cabang_Olahraga::select('nama_cabor','id_cabor')->get();

    	$data['atlet'] = Master_Atlet::select('nama_atlet','id_atlet')
    						->get();

        $data['tingkat_event'] = Tingkat_Event::select('*')->get();

        $data['event'] = Event::select('id_event','nama_event')->get();


    	return view('rekor.tambahRekor',$data);
    }

    public function add(Request $Request){
    	$data  = new Rekor_Atlet();
        $data->id_rekor	        = null;
        $data->atlet_id         = $Request->atlet;
        $data->keterangan_rekor = $Request->ket_rekor;
        $data->cabor_id         = $Request->cabor;
        $data->np_id            = $Request->np;
        $data->event_id         = $Request->event;
        $data->waktu            = $Request->waktu;
        $save = $data->save();
        if($save){
            return redirect()->route('tampilRekor')->with(['status' => 'success', 'message' => 'Data berhasil ditambahkan']);
        }        
    }

    public function update(Request $Request){
        $data  = Rekor_Atlet::select('*')            
            ->where('id_rekor',$Request->id_rekor)
            ->update([
                'keterangan_rekor'         => $Request->ket_rekor,
                'cabor_id'                 => $Request->cabor,
                'np_id'                    => $Request->np,
                'atlet_id'                 => $Request->atlet,
                'event_id'                 => $Request->event,
                'waktu'                    => $Request->waktu
                ]);
        return redirect()->route('tampilRekor')->with(['status' => 'success','message' => 'Data berhasil dirubah']);
    }

    public function getRekor(Request $Request){
    	$data = Rekor_Atlet::select('nama_atlet','keterangan_rekor','ket_np','nama_cabor','id_rekor','waktu','nama_event')
    		->leftJoin('cabang_olahraga','id_cabor','=','cabor_id')
    		->leftJoin('master_atlet','id_atlet','=','atlet_id') 
    		->leftJoin('nomor_pertandingan','id_np','=','np_id')
    		->leftJoin('event','id_event','=','event_id')
    		->where('id_rekor',$Request->id)
	        ->first();

	    echo json_encode($data);
    }

    public function delete($id){
        $data = Rekor_Atlet::select('*')->where('id_rekor',$id)->first();
        $data->delete();

        return redirect()->route('tampilRekor')->with(['status'=>'success','message'=>'Data berhasil dihapus']);
    }
    
}
