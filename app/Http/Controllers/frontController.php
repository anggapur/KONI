<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Master_Atlet;

class frontController extends Controller
{
    //
    public function index()
    {
    	return view('front.index');
    }
    public function atlet()
    {
    	return view('front.atlet');
    }
    public function prestasiAtlet()
    {
        return view('front.prestasi-atlet');
    }
    public function pelatih()
    {
        return view('front.pelatih');
    }
    public function wasit()
    {
        return view('front.wasit');
    }
    public function event()
    {
        return view('front.event');
    }
    public function cabor()
    {
        return view('front.cabor');
    }
    public function rekor()
    {
        return view('front.rekor');
    }
    public function dataGrafik()
    {
    	return view('front.grafik');
    }
    public function dataAtlet(){          
      return Datatables::of(Master_Atlet::query())->make(true);  
    }
}
