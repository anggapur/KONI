<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Kontingen;
use App\Cabang_Olahraga;
use App\Jabatan;

class KontingenController extends Controller
{   
    public function index()
    {
    	$data = [];
    	$data['active'] = 'Kontingen';
    	$data['page'] = 'Kontingen';
    	return view('kontingen.kontingen', ['data' => $data]);
    }

    public function add(Request $Request){
    	//dd($Request);    	

    	$data  = new Kontingen();
    	$data->id_kontingen				= null;
    	$data->nama_kontingen 			= $Request->nama;
    	$data->no_kartu_tanda_anggota	= $Request->nkta;
    	$data->jenis_kelamin			= $Request->jenis_kelamin;
    	$data->tempat_lahir				= $Request->tempat_lahir;
    	$data->tgl_lahir				= $Request->tgl_lahir;
    	$data->alamat					= $Request->alamat;
    	$data->jabatan_id				= $Request->jabatan;
    	$data->kabupaten_id				= 1;
    	$data->foto_id					= 1;
        $data->cabor_id                 = $Request->cabor_id;
    	$data->save();

    	return redirect()->route('kontingen');
    }

    public function tambah(){
        $data = [];
    	$data['jabatan'] = Jabatan::select('*')->get();
        $data['cabor'] = Cabang_Olahraga::select('*')->get();
    	$data['active'] = 'Kontingen';
    	$data['page'] = 'Tambah Kontingen';
    	return view('kontingen.tambah-kontingen',$data);
    }

    public function edit($id){

        $data = Kontingen::select('*')
            ->leftJoin('jabatan','id_jabatan','=','jabatan_id')
            ->where('id_kontingen',$id)
            ->first();

        $data['cabor'] = Cabang_Olahraga::select('*')->get();
        $data['jabatan'] = Jabatan::select('*')->get();

        $data['active'] = 'Kontingen';
        $data['page'] = 'Edit Kontingen';

        return view('kontingen.edit-kontingen',$data );   
    }

    public function dataKontingen(){    	

        $data = Kontingen::select('nama_kontingen','jabatan.nama_jabatan','id_kontingen','nama_cabor')
            ->leftJoin('cabang_olahraga','cabor_id','=','id_cabor')
	        ->leftJoin('jabatan','jabatan_id','=','jabatan.id_jabatan')
	        ->get();        


	        

      return Datatables::of($data)
      ->addColumn('aksi', function($data){
      	return "<button onclick='view(".$data->id_kontingen.")' class='btn btn-xs btn-warning'> <i class='fa fa-eye'> </i> View </button>
      		<a href=".route('kontingen-edit',$data->id_kontingen)."><button class='btn btn-xs btn-primary'> <i class='fa fa-edit'> </i> Edit  </button> </a>
      		<button onclick='hapus(\"".$data->nama_kontingen."\",".$data->id_kontingen.")' class='btn btn-xs btn-danger'> <i class='fa fa-trash'> </i> Hapus  </button>";
      })

      ->make(true);
    }

    public function getData(Request $Request){
    	$data = Kontingen::select('*')
            ->leftJoin('jabatan','id_jabatan','=','jabatan_id')
	        ->where('id_kontingen',$Request->id)
	        ->first();

	    echo json_encode($data);
    }

    public function hapus(Request $Request){        
        $data = Kontingen::select('*')->where('id_kontingen',$Request->id)->first();
        $data->delete();

        return "success";
    }

    public function update(Request $Request){        
        $data  = Kontingen::select('*')            
            ->where('id_kontingen',$Request->id)
            ->update([
                'nama_kontingen'           => $Request->nama,                        
                'no_kartu_tanda_anggota'   => $Request->nkta,
                'jenis_kelamin'            => $Request->jenis_kelamin,
                'tempat_lahir'             => $Request->tempat_lahir,
                'tgl_lahir'                => $Request->tgl_lahir,
                'alamat'                   => $Request->alamat,                
                'jabatan_id'               => $Request->jabatan,
                'cabor_id'                 => $Request->cabor_id
    
                ]);

        return redirect()->route('kontingen');  
    }

    public function cekKartu(Request $Request){
        $data = Kontingen::select('id_kontingen')->where('no_kartu_tanda_anggota',$Request->no)->count();
        if($data > 0){
            echo "false";
        }
        else{
            echo "true";
        }
    }
}
