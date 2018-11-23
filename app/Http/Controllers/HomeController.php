<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nomor_Pertandingan;
class HomeController extends Controller
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
<<<<<<< HEAD
        $data = [];
        $data['page'] = 'Dashboard';
        return view('home',['data' => $data]);
=======

        $data['page'] = 'Dashboard';
        return view('home',$data);
        //return view('home');
        //return view('home');

    }
    public function simpan(Request $request)
    {
        $data['id_cabor'] = $request->id_cabor;
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
>>>>>>> f52c20be45763e940adc7af8440d48b57c294b30
    }
}

