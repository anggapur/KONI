<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nomor_Pertandingan;
use App\Cabang_Olahraga;

class noPertandingan extends Controller

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
        $data['listCabangOlahraga'] = Cabang_Olahraga::select('*')->get();
        $data['page'] = "Cabang Olahraga";        
        $data['active'] = "Cabang Olahraga";
        return view('noPertandingan',$data);
    }
    public function simpan(Request $request)
    {
        $data['cabor_id'] = $request->cabor_id;
        $data['ket_np'] = $request->ket_np;
        $query = Nomor_Pertandingan::create($data);
        if($query)
        {
            return "Berhasil";
        }
        else
        {
            return "Sukses";
        }

    }
}




