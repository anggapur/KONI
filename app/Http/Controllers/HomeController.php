<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nomor_Pertandingan;
use App\Master_Atlet;
use App\Cabang_Olahraga;
use App\Wasit;
use App\Kontingen;
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

        $data = [];
        $data['page'] = 'Dashboard';
        return view('home',['data' => $data]);

        $data['page'] = 'Dashboard';
        $data['countAtlet'] = Master_Atlet::get()->count();
        $data['countCabor'] = Cabang_Olahraga::get()->count();
        $data['countWasit'] = Wasit::get()->count();
        $data['countPelatih'] = Kontingen::where('jabatan_id','2')->get()->count();
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

    }
}

