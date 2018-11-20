<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Master_Atlet;
use GH;
use App\Cabang_Olahraga;
use Response;
use DB;
use Carbon;
class frontController extends Controller
{
    //
    public function index()
    {   
    	return view('front.index');
    }
    public function atlet()
    {
       
        // return Response::json($data, 200, array(), JSON_PRETTY_PRINT);
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
        $q = Master_Atlet::leftJoin('cabang_olahraga','cabor_id','=','id_cabor')
        ->select('nama_atlet','cabang_olahraga.nama_cabor');      
      return Datatables::of($q)->make(true);  
    }

    public function getApiData(Request $request)
    {
        if($request->name == "getPrestasiByCabor")
        {
            $data = [];
            $count = 0;
            foreach(GH::getPrestasiByCabor() as $key => $val)
            {
                $datas[0] = $key;
                $datas[1] = $val;
                array_push($data, $datas);
                $count+=$val;
            }
            $data['data'] = $data;
            $data['sumAllData'] = $count;
            return $data;
        }
        else if($request->name == "getAtletByJenisKelaminAndUmur")
        {
            return GH::getAtletByJenisKelaminAndUmur();
        }
        else if($request->name == "getAtletByCabor")
        {
            $data = [];
            $count = 0;
            foreach(GH::getAtletByCabor() as $key => $val)
            {
                $datas[0] = $key;
                $datas[1] = $val;
                array_push($data, $datas);
                $count+=$val;
            }
            $data['data'] = $data;
            $data['countAtlet'] = $count;
            return $data;
        }
        else if($request->name == "getPrestasiByEvent")
        {
            $data = [];
            foreach(GH::getPrestasiByEvent() as $key => $val)
            {
                $datas[0] = $key;
                $datas[1] = $val;
                array_push($data,$datas);
            }
            return $data;
        }
    }
}

