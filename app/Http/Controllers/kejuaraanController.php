<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Event;

use Yajra\Datatables\Datatables;

class kejuaraanController extends Controller
{
    public function index()
    {
    	$data['page'] = "Event";        
        $data['active'] = "Event";
    	return view('Kejuaraan.kejuaraan',$data);
    }
    public function simpan(Request $request)
    {
    	$data ['nama_event']=$request->nama_event;
    	$data['lokasi']=$request->lokasi;
    	$data['tgl_mulai']=$request->tgl_mulai;
    	$data['tgl_selesai']=$request->tgl_selesai;
    	$query = Event::create($data);
    	if($query)
        {
            return redirect()->route('kejuaraan')->with('status','success');

        }
        else
        {
            echo "Sukses";
           
        }
    }
    public function tampil()
    {
    	$data['page'] = "Event";        
        $data['active'] = "Event";
        return view ('tampilEvent',$data);
    }
    public function getData()
    {
    	$data=Event::select('nama_event','lokasi','tgl_mulai','tgl_selesai','id_event')->get();

    	return Datatables::of($data)
    	->addColumn('aksi', function($data){
        return "
            <a href=".route('editEvent',$data->id_event)."><button class='btn btn-xs btn-primary'> <i class='fa fa-edit'> </i> Edit  </button> </a>
            <a href=".url('hapusEvent/'.$data->id_event)."><button class='btn btn-xs btn-danger'> <i class='fa fa-trash'> </i> Hapus  </button> </a>";
      })

      ->make(true);
    }
    public function edit($id)
    {
    	$data['page'] = "Event";        
        $data['active'] = "Event";
        $data['data_event']=Event::select('*')->where ('id_event',$id)->first();
        return view('editEvent',$data);
    }
    public function update(Request $request)
    {
        //dd($request);
        $data['id_event'] = $request->id_event;
        $data['nama_event'] = $request->nama_event;
        $data['lokasi'] = $request->lokasi;
        $data['tgl_mulai'] = $request->tgl_mulai;
        $data['tgl_selesai'] = $request->tgl_selesai;
        $update=Event::select('*')->where('id_event',$request->id_event)
        ->update([
            'nama_event' => $data['nama_event'],
            'lokasi'=>$data['lokasi'],
            'tgl_mulai'=>$data['tgl_mulai'],
            'tgl_selesai'=>$data['tgl_selesai']
            ]);

        return redirect()->route('kejuaraan')->with('status','edited');    
    }
    public function hapus($id)
    {
        $query=Event::where('id_event',$id)->delete();
        if($query)
            return redirect('tampilEvent')->with('status','deleted');
        else
            echo "gagal";
    }
}
