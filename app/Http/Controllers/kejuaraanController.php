<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Event;
use App\Detail_Event;
use App\Cabang_Olahraga;
use App\Tingkat_Event;
use Response;
use Yajra\Datatables\Datatables;

class kejuaraanController extends Controller
{
    public function index()
    {
    	$data['page'] = "Event";        
        $data['active'] = "Event";
        $data['tingkat'] = Tingkat_Event::select('*')->get();
        $data['cabor'] = Cabang_Olahraga::select('nama_cabor','id_cabor')->get();
    	return view('Kejuaraan.kejuaraan',$data);
    }
    public function simpan(Request $request)
    {
        //dd($request);    	

        $event = new Event();
        $event->id_event = null;
        $event->nama_event = $request->nama_event;
        $event->lokasi = $request->lokasi;
        $event->tingkat_id = $request->tingkat_event;
        $event->tgl_mulai = $request->tanggal_mulai;
        $event->tgl_selesai = $request->tanggal_selesai;
        $event->save();

        $data['cabor_id'] = [];
        foreach ($request->id_cabor as $temp) {
            array_push($data['cabor_id'],$temp);
        }
        $data['cabor'] = [];
        foreach ($request->cabor as $temp) {
            array_push($data['cabor'],$temp);
        }
        $data['eksebisi'] = [];
        foreach ($request->eksebisi as $temp) {
            array_push($data['eksebisi'],$temp);
        }
        $data['tgl_mulai'] = [];
        foreach ($request->tgl_mulai as $temp) {
            array_push($data['tgl_mulai'],$temp);
        }
        $data['tgl_selesai'] = [];
        foreach ($request->tgl_selesai as $temp) {
            array_push($data['tgl_selesai'],$temp);
        }
        $data['wkt_mulai'] = [];
        foreach ($request->wkt_mulai as $temp) {
            array_push($data['wkt_mulai'],$temp);
        }
        $data['wkt_selesai'] = [];
        foreach ($request->wkt_selesai as $temp) {
            array_push($data['wkt_selesai'],$temp);
        }
        $data['tempat'] = [];
        foreach ($request->tempat as $temp) {
            array_push($data['tempat'],$temp);
        }

        $count = count($data['cabor']);
        //dd(abs(strtotime($data['tgl_mulai'][0])-strtotime($data['tgl_selesai'][0])));

        for($i=0;$i<$count;$i++){
            if($data['cabor'][$i] == 'on'){  
                $detail = new Detail_Event();
                $detail->id_detail = null;
                $detail->event_id = $event->id_event;
                $detail->cabor_id = $data['cabor_id'][$i];
                $long = abs(strtotime($data['tgl_mulai'][$i])-strtotime($data['tgl_selesai'][$i]));
                $long = $long/(3600*24);
                $detail->lama_pertandingan = $long;
                $detail->tgl_mulai =  $data['tgl_mulai'][$i];
                $detail->tgl_selesai = $data['tgl_selesai'][$i];
                $detail->tempat_pertandingan = $data['tempat'][$i];
                $detail->waktu_mulai = $data['wkt_mulai'][$i];
                $detail->waktu_selesai = $data['wkt_selesai'][$i];
                if($data['eksebisi'][$i] == 'on') 
                    $detail->status_cabor = "Eksibisi";
                else
                    $detail->status_cabor = 'Tidak';
                //dd($detail);
                $detail->save();
            }
        }
    	
    	
        return redirect()->route('Kejuaraan')->with(['status' => 'success','message' => 'Data berhasil ditambahkan']);
        
    }
    public function tampil()
    {
    	$data['page'] = "Event";        
        $data['active'] = "Event";
        return view ('Kejuaraan.tampilEvent',$data);
    }
    public function getData()
    {
    	$data=Event::select('nama_event','lokasi','tgl_mulai','tgl_selesai','id_event','nama_tingkat')
        ->leftJoin('tingkat_event','id_tingkat','=','tingkat_id')
        ->get();

    	return Datatables::of($data)
    	->addColumn('aksi', function($data){
        return "<button onclick='view(".$data->id_event.")' class='btn btn-xs btn-warning'><i class='fa fa-eye'></i> View</button>
            <a href=".route('editEvent',$data->id_event)."><button class='btn btn-xs btn-primary'> <i class='fa fa-edit'> </i> Edit  </button> </a>
            <button onclick='del(\"".$data->nama_event."\",".$data->id_event.")' class='btn btn-xs btn-danger'> <i class='fa fa-trash'> </i> Hapus  </button>";
      })

      ->make(true);
    }
    public function edit($id)
    {
    	$data['page'] = "Event";        
        $data['active'] = "Event";
        $data['data_event']=Event::select('*')->where('id_event',$id)->first();
        $data['tingkat'] = Tingkat_Event::select('*')->get();        
        $data['cabor'] = Cabang_Olahraga::select('*')
        ->with(['toDetailEvent' => function($q) use ($id){
            $q->where('event_id',$id);
        }])
        ->orderBy('id_cabor')
        ->get();
        //return Response::json($data['cabor'],200,array(),JSON_PRETTY_PRINT);
        //dd($data['cabor']);
        //$data['detail'] = Detail_Event::select('*')->where('id_detail',$id)->get();
        return view('Kejuaraan.editEvent',$data);
    }
    public function update(Request $request)
    {
        //dd($request);
        $data['id_event'] = $request->id_event;
        $data['nama_event'] = $request->nama_event;
        $data['tingkat_id'] = $request->tingkat_event;
        $data['lokasi'] = $request->lokasi;
        $data['tgl_mulai'] = $request->tanggal_mulai;
        $data['tgl_selesai'] = $request->tanggal_selesai;
        $update=Event::select('*')->where('id_event',$request->id_event)
        ->update([
            'nama_event' => $data['nama_event'],
            'lokasi'=>$data['lokasi'],
            'tingkat_id'=>$data['tingkat_id'],
            'tgl_mulai'=>$data['tgl_mulai'],
            'tgl_selesai'=>$data['tgl_selesai']
            ]);

        $data['id_detail'] = [];
        foreach ($request->id_detail as $temp) {
            array_push($data['id_detail'],$temp);
        }
        $data['cabor_id'] = [];
        foreach ($request->id_cabor as $temp) {
            array_push($data['cabor_id'],$temp);
        }
        $data['cabor'] = [];
        foreach ($request->cabor as $temp) {
            array_push($data['cabor'],$temp);
        }
        $data['eksebisi'] = [];
        foreach ($request->eksebisi as $temp) {
            array_push($data['eksebisi'],$temp);
        }
        $data['tgl_mulai'] = [];
        foreach ($request->tgl_mulai as $temp) {
            array_push($data['tgl_mulai'],$temp);
        }
        $data['tgl_selesai'] = [];
        foreach ($request->tgl_selesai as $temp) {
            array_push($data['tgl_selesai'],$temp);
        }
        $data['wkt_mulai'] = [];
        foreach ($request->wkt_mulai as $temp) {
            array_push($data['wkt_mulai'],$temp);
        }
        $data['wkt_selesai'] = [];
        foreach ($request->wkt_selesai as $temp) {
            array_push($data['wkt_selesai'],$temp);
        }
        $data['tempat'] = [];
        foreach ($request->tempat as $temp) {
            array_push($data['tempat'],$temp);
        }

        $count = count($data['cabor']);

        for($i=0;$i<$count;$i++){
            $cek = Detail_Event::select('*')
                    ->where('cabor_id',$data['cabor_id'][$i])
                    ->where('event_id',$data['id_event'])                    
                    ->count();
            if($cek > 0){
                if($data['cabor'][$i] == 'on'){ 
                    if($data['eksebisi'][$i] == 'on')
                        $status = "Eksibisi";
                    else
                        $status = "Tidak";
                    $update=Detail_Event::select('*')->where('id_detail',$data['id_detail'][$i])
                    ->update([
                        'tempat_pertandingan' => $data['tempat'][$i],
                        'waktu_mulai'=>$data['wkt_mulai'][$i],
                        'waktu_selesai'=>$data['wkt_selesai'][$i],                    
                        'tgl_mulai'=>$data['tgl_mulai'][$i],
                        'tgl_selesai'=>$data['tgl_selesai'][$i],
                        'lama_pertandingan'=>(abs(strtotime($data['tgl_mulai'][$i])-strtotime($data['tgl_selesai'][$i]))/(3600*24)),
                        'status_cabor'=>$status
                        ]);                
                }
                else{
                    $del = Detail_Event::select('*')->where('id_detail',$data['id_detail'][$i])->delete();
                }
            }else if($cek == 0 && $data['cabor'][$i] == 'on'){
                $detail = new Detail_Event();
                $detail->id_detail = null;
                $detail->event_id = $data['id_event'];
                $detail->cabor_id = $data['cabor_id'][$i];
                $long = abs(strtotime($data['tgl_mulai'][$i])-strtotime($data['tgl_selesai'][$i]));
                $long = $long/(3600*24);
                $detail->lama_pertandingan = $long;
                $detail->tgl_mulai =  $data['tgl_mulai'][$i];
                $detail->tgl_selesai = $data['tgl_selesai'][$i];
                $detail->tempat_pertandingan = $data['tempat'][$i];
                $detail->waktu_mulai = $data['wkt_mulai'][$i];
                $detail->waktu_selesai = $data['wkt_selesai'][$i];
                if($data['eksebisi'][$i] == 'on') 
                    $detail->status_cabor = "Eksibisi";
                else
                    $detail->status_cabor = 'Tidak';
                //dd($detail);
                $detail->save();
            }
        }

        return redirect()->route('Kejuaraan')->with(['status' => 'success','message' => 'Data berhasil dirubah']);
    }
    public function hapus($id)
    {   
        $query=Detail_Event::where('event_id',$id)->delete();
        $query=Event::where('id_event',$id)->delete();
        //dd($query);
        if($query)
            return redirect()->route('Kejuaraan')->with(['status' => 'success','message' => 'Data berhasil dihapus']);
    }

    public function getDataEvent(Request $Request){
        $data['event'] = Event::select('*')
            ->leftJoin('tingkat_event','id_tingkat','=','tingkat_id')            
            ->where('id_event',$Request->id)
            ->first();

        $data['detail'] = Detail_Event::select('*')
            ->leftJoin('Cabang_Olahraga','id_cabor','=','cabor_id')
            ->where('event_id',$Request->id)
            ->where('status_cabor','Tidak')
            ->get();
    //dd($data['detail']);

        for ($i=0; $i < count($data['detail']); $i++) { 
            $data['detail'][$i]->tgl_mulai = date('d M Y',strtotime($data['detail'][$i]->tgl_mulai));
            $data['detail'][$i]->tgl_selesai = date('d M Y',strtotime($data['detail'][$i]->tgl_selesai));
            $data['detail'][$i]->waktu_mulai = date('H:m',strtotime($data['detail'][$i]->waktu_mulai));
            $data['detail'][$i]->waktu_selesai = date('H:m',strtotime($data['detail'][$i]->waktu_selesai));
        }

        $data['eksebisi'] = Detail_Event::select('*')
            ->leftJoin('Cabang_Olahraga','id_cabor','=','cabor_id')
            ->where('event_id',$Request->id)
            ->where('status_cabor','Eksibisi')
            ->get();

        for ($i=0; $i < count($data['eksebisi']); $i++) { 
            $data['eksebisi'][$i]->tgl_mulai = date('d M Y',strtotime($data['eksebisi'][$i]->tgl_mulai));
            $data['eksebisi'][$i]->tgl_selesai = date('d M Y',strtotime($data['eksebisi'][$i]->tgl_selesai));
            $data['eksebisi'][$i]->waktu_mulai = date('H:m',strtotime($data['eksebisi'][$i]->waktu_mulai));
            $data['eksebisi'][$i]->waktu_selesai = date('H:m',strtotime($data['detail'][$i]->waktu_selesai));
        }

        echo json_encode($data);
    }

}
