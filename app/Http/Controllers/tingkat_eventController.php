<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;
use App\Tingkat_Event;
use App\Jabatan;

class tingkat_eventController extends Controller
{
	public function tambahEvent()
	{
		$data = [];
    	$data['datatingkat'] = Tingkat_Event::select('*')->get();
    	$data['page'] = "Tingkat Event";
    	return view('tingkat_event.tambah_tingkat_event',$data);
	}
	public function simpan(Request $request)
    {
        //return $request->all();
    	//$data  = new tingkat_event();
    	$data['nama_tingkat'] = $request->nama_tingkat;
    	$query = Tingkat_Event::create($data);
    	 if($query)
    	 	return redirect('tampildata_event')->with(['status' => 'success' , 'message' => 'Berhasil Simpan Data']);
    	 else
    	 	echo "Gagal";

    }
    public function editEvent($id)
	{
		$data = [];
    	$data['datatingkat'] = Tingkat_Event::select('*')->get();
    	$data['page'] = "Tingkat Event";
    	$data['tingkat']=Tingkat_Event::where('id_tingkat',$id)->first();
    	return view('tingkat_event.edit_tingkat_event',$data);
	}

    public function updatedata(Request $request)
    {
        // return $request->all();
        $data['nama_tingkat'] = $request->nama_tingkat;
        $query = Tingkat_Event::where('id_tingkat', $request->id_tingkat)->update($data);
        //return $request->all();
        //if($query)
            return redirect('tampildata_event')->with(['status' => 'success' , 'message' => 'Berhasil Update Data']);
        //else
        //  echo "Gagal";
    }

    public function tampilEvent()
    {
    	$data['page'] = "Tingkat Event";
    	$data['datatingkat']=Tingkat_Event::select('*') ->get();
    	return view('tingkat_event.tampilEvent',$data);
    }

    public function deleteEvent($id)
    {
        $query= Tingkat_Event::where('id_tingkat',$id)->delete();
        if($query)
            return redirect('tampildata_event')->with(['status' => 'success' , 'message' => 'Berhasil Hapus Data']);
        else
            echo "Gagal";
    }

    public function getdataEvent(Request $request)
    {
   
    	    	$data = Tingkat_Event::select('*')->first();

	    echo json_encode($data);
    }
}
