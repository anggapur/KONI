<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Master_Atlet;
use App\Prestasi;
use GH;
use App\Cabang_Olahraga;
use App\Event;
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
        ->select('id_atlet','nama_atlet','cabang_olahraga.nama_cabor');      
      return Datatables::of($q)
            ->editColumn('nama_atlet', function($user) {
                    return '<a href="'.url('atlet').'/'.$user->id_atlet.'/'.GH::normalize($user->nama_atlet).'">' . $user->nama_atlet . '</a>';
                })
            ->make(true);  
    }      
    public function dataPrestasi()
    {
        $q = Prestasi::leftJoin('master_atlet','master_atlet.id_atlet','=','prestasi.atlet_id')
                ->leftJoin('cabang_olahraga','cabang_olahraga.id_cabor','=','prestasi.cabor_id')
                ->leftJoin('nomor_pertandingan','nomor_pertandingan.id_np','=','prestasi.np_id')
                ->leftJoin('event','event.id_event','=','prestasi.event_id');
        return Datatables::of($q)
                ->editColumn('nama_atlet', function($user) {
                    return '<a href="'.url('atlet').'/'.$user->id_atlet.'/'.GH::normalize($user->nama_atlet).'">' . $user->nama_atlet . '</a>';
                })
                ->make(true);
    } 
    public function dataEvent()
    {
        $q = Event::all();
        return Datatables::of($q)
        ->editColumn('nama_event', function($user) {
                    return '<a href="'.url('event').'/'.$user->id_event.'/'.GH::normalize($user->nama_event).'">' . $user->nama_event . '</a>';
                })
            ->addColumn('berlangsung', function($user) {
                    return Carbon\Carbon::parse($user->tgl_mulai)->format('d M Y')." - ".Carbon\Carbon::parse($user->tgl_akhir)->format('d M Y');
                })
            ->addColumn('total_prestasi', function($user) {
                    return $user->getPrestasi->count();
                })
            ->make(true);
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

    public function detailAtlet($id,$nama)
    {
        $query = Master_Atlet::where('id_atlet',$id);
        //cari apakah ada yang id sekian
        if($query->get()->count() <=0)
            return redirect('404');
        //kalau lolos
        $data['dataAtlet'] = $query
                            ->leftJoin('foto','id_foto','foto_id')
                            ->leftJoin('cabang_olahraga','id_cabor','cabor_id')
                            ->with(['getPrestasi' => function($q){
                                $q->leftJoin('cabang_olahraga','cabang_olahraga.id_cabor','=','prestasi.cabor_id');
                                $q->leftJoin('event','event.id_event','=','prestasi.event_id');
                                $q->leftJoin('nomor_pertandingan','nomor_pertandingan.id_np','=','prestasi.np_id');
                            }])
                            ->first();
        return view('front.detailAtlet',$data);

    }
}

