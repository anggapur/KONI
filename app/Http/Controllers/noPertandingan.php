<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nomor_Pertandingan;

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




