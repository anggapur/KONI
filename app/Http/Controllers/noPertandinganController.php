<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nomor_Pertandingan;
use App\Cabang_Olahraga;

use Yajra\Datatables\Datatables;


class noPertandinganController extends Controller

{
	
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    	// $data['page'] = "Nomor Pertandingan";
    	// $data['cabor'] = Cabang_Olahraga::select("*")->get();
     //    return view('noPertandingan',['data' => $data]);

        $data['listCabangOlahraga'] = Cabang_Olahraga::select('*')->get();
        $data['page'] = "Nomor Pertandingan";        
        $data['active'] = "Nomor Pertandingan";
        return view('nomor_pertandingan.noPertandingan',$data);

    }
    public function simpan(Request $request)
    {
        $data['cabor_id'] = $request->cabor_id;
        $data['ket_np'] = $request->ket_np;
        $query = Nomor_Pertandingan::create($data);
        if($query)
        {
            return redirect()->route('nomorPertandingan')->with(['status' => 'success','message' => 'Data berhasil ditambahkan']);

        }        
    }
    public function tampil()
    {
        $data['page'] = "Nomor Pertandingan";        
        $data['active'] = "Nomor Pertandingan";
        return view('nomor_pertandingan.tampilNoPertandingan',$data);

    }
    public function getdata()
    {
         $data = Nomor_Pertandingan::select('nama_cabor','ket_np','id_np')
            ->leftJoin('cabang_olahraga','cabor_id','=','id_cabor')
            ->get();

            

      return Datatables::of($data)
      ->addColumn('aksi', function($data){
        return "
            <a href=".route('editNoPertandingan',$data->id_np)."><button class='btn btn-xs btn-primary'> <i class='fa fa-edit'> </i> Edit  </button> </a>
            <button onclick='del(".$data->id_np.",\"".$data->ket_np."\")' class='btn btn-xs btn-danger'> <i class='fa fa-trash'> </i> Hapus  </button>";
      })

      ->make(true);
    }
    public function tambah()
    {
        $data['listCabangOlahraga'] = Cabang_Olahraga::select('*')->get();
        $data['page'] = "Nomor Pertandingan";        
        $data['active'] = "Nomor Pertandingan";
        return view('nomor_pertandingan.noPertandingan',$data);
    }
    public function editNoPertandingan($id)
    {
        $data['listCabangOlahraga'] = Cabang_Olahraga::select('*')->get();
        $data['data_np']=Nomor_Pertandingan::select('*')->where ('id_np',$id)->first();
        $data['page'] = "Nomor Pertandingan";        
        $data['active'] = "Nomor Pertandingan";
       //    dd($data);
        return view('nomor_pertandingan.editNoPertandingan',$data);
    }
    public function update(Request $request)
    {
        $data['id_np'] = $request->id_np;
        $data['cabor_id'] = $request->cabor_id;
        $data['ket_np'] = $request->ket_np;
        $update=Nomor_Pertandingan::select('*')->where('id_np',$request->id_np)
        ->update([
            'cabor_id' => $data['cabor_id'],
            'ket_np'=>$data['ket_np']
            ]);

        return redirect()->route('nomorPertandingan')->with(['status' => 'success','message' => 'Data berhasil dirubah']);            
    }
    public function hapus($id)
    {
        $query=Nomor_Pertandingan::where('id_np',$id)->delete();
        if($query)
            return redirect('tampilNoPertandingan')->with(['status' => 'success','message' => 'Data berhasil dihapus']);        
    }
}




