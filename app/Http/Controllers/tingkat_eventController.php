<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;
use app\TingkatEvent;

class tingkat_eventController extends Controller
{
	public function tambahEvent()
	{
		$data = [];
    	$data['datatingkat'] = TingkatEvent::select('*')->get();
    	$data['page'] = "Tingkat Event";
    	return view('tingkat_event.tambah_tingkat_event',$data);
	}
	public function simpan(Request $request)
    {
    	//$data  = new tingkat_event();
    	$data['nama_tingkat'] = $request->nama_tingkat;
    	$query = TingkatEvent::create($data);
    	 if($query)
    	 	return redirect('tambahEvent')->with(['status' => 'success' , 'message' => 'Berhasil Simpan Data']);
    	 else
    	 	echo "Gagal";

    }
    public function editEvent($id)
	{
		$data = [];
    	$data['datatingkat'] = tingkat_event::select('*')->get();
    	$data['page'] = "Tingkat Event";
    	$data['tingkat']=tingkat_event::where('id_tingkat',$id)->first();
    	return view('tingkat_event.tambah_tingkat_event',$data);
	}

    public function tampilEvent()
    {
    	$data['page'] = "Tingkat Event";
    	$data['datatingkat']= tingkat_event::select('*') ->get();
    	return view('tingkat_event.tampilEvent',$data);
    }
    public function getdataEvent(Request $request)
    {
   
    	    	$data = tingkat_event::select('*')->first();

	    echo json_encode($data);
    }
}
