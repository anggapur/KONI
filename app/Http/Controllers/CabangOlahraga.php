<?php

namespace App\Http\Controllers;


use Yajra\Datatables\Datatables;

use Illuminate\Http\Request;
use App\Cabang_Olahraga;

class CabangOlahraga extends Controller
{
    //
    public function index()
    {
    	$data = [];
    	$data['active'] = "Cabang_Olahraga";
    	$data['page'] = 'Cabang Olahraga';
    	return view('cabor.IndexCabor',$data);
    }
    public function add(Request $Request)
    {
    	$data = new Cabang_Olahraga();
    	$data->id_cabor = null;
    	$data->nama_cabor = $Request->cabor;
    	$save=$data->save(); 
    	if($save)
    		return redirect()->route('Cabor')->with(['status' => 'success', 'message' => 'Data berhasil ditambahkan']);
    }
    public function tambahcabor()
    {
   		$data = [];
    	$data['active'] = "Cabang_Olahraga";
    	$data['page'] = 'Cabang Olahraga';
    	return view('cabor.TambahCabor',$data);
    }
    public function edit_Cabor($id)
	{

	 	$data['cabor'] = Cabang_Olahraga::select('*')->where('id_cabor',$id)->first();
		$data['active'] = "Cabang_Olahraga";
		$data['page'] = 'Cabang Olahraga';
		return view('cabor.EditCabor',$data);
	}
    public function hasil_editcabor(Request $request)
	{		
			$data  = Cabang_Olahraga::select('*')    
            ->where('id_cabor',$request->id)
            ->update([
                'nama_cabor'           => $request->cabor
                ]);

        //dd($data);

        return redirect()->route('Cabor')->with(['status' => 'success', 'message' => 'Data berhasil dirubah']);
	}
    public function dataCabor()
    {
    	$data= Cabang_Olahraga::select('id_cabor','nama_cabor')->get();

    	  return Datatables::of($data)
      ->addColumn('aksi', function($data){
      	return "
      		<a href=".route('edit-cabor',$data->id_cabor)."><button class='btn btn-xs btn-primary'> <i class='fa fa-edit'> </i> Edit  </button> </a>
      		<button onclick='hapus(\"".$data->nama_cabor."\",".$data->id_cabor.")' class='btn btn-xs btn-danger'> <i class='fa fa-trash'> </i> Hapus  </button>";
      })

      ->make(true);
    }
   	public function hapus($id){
    $data = Cabang_Olahraga::select('*')->where('id_cabor',$id)->first();
    $data->delete();
    return redirect()->route('Cabor')->with(['status' => 'success', 'message' => 'Data berhasil dihapus']);
    }
}
