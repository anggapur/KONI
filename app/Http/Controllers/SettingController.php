<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Setting;
use DB;
use GH;


class SettingController extends Controller
{
    //
    public function index()
    {    	
    	$data['active'] = 'Setting';
    	$data['page'] = 'Setting';
    	return view('setting.index', $data);
    }

    public function create()
    {    	
    	$data['active'] = 'Setting';
    	$data['page'] = 'Setting';
    	return view('setting.create', $data);
    }

    public function edit($id)
    {    
        $data['setting'] = Setting::select('*')->where('id_setting',$id)->first();
    	$data['active'] = 'Setting';
    	$data['page'] = 'Setting';
    	return view('setting.edit', $data);
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        $ruleValidasi = [
            'attr' => 'required',
            'value' => 'required',
            'status' => 'required',
            'type' => 'required',
            'deskripsi' => 'required',
        ];
        $pesanErrorCustom = [
            'required' => 'Kolom :attribute Harus diisi.'
        ];
        $request->validate($ruleValidasi,$pesanErrorCustom);        
        if($request->type == 'image'){
        	$data['value'] = rand(0,1000).'_'.$request->file('value')->getClientOriginalName();

        	$request->file('value')->move("public/upload/slider", $data['value']);
        }

        $query = Setting::create($data);
        if($query)
            return redirect('setting')->with(['status'=>'success' , 'message' => 'Berhasil Tambah Setting']);
    }

    public function update(Request $request,$id)
    {
        $data = $request->except('_token','_method');

        $ruleValidasi = [            
            'value' => 'required',            
        ];
        $pesanErrorCustom = [
            'required' => 'Kolom :attribute Harus diisi.'
        ];
        $request->validate($ruleValidasi,$pesanErrorCustom);

        $temp = Setting::select('*')->where('id_setting',$id)->first();

        if($temp->type == 'image'){
            $data['value'] = rand(0,1000).'_'.$request->file('value')->getClientOriginalName();

            $request->file('value')->move("public/upload/slider", $data['value']);
        }
        
        $query = Setting::where('id_setting',$id)->update(['value'=> $data['value'], 'status' => $data['status']]);

        if($query)
            return redirect('setting')->with(['status'=>'success' , 'message' => 'Berhasil Tambah Setting']);
    }

    public function getData(){
    	$data = Setting::select('*')->get();

	      return Datatables::of($data)
	      ->editColumn('value', function($data){
	      	if($data->type =='image')
	      		return "<a href='public/upload/slider/".$data->value."' target='_blank'>".$data->value."</a>";
	      	else
	      		return $data->value;
	      })
	      ->addColumn('aksi', function($data){
	      	return "<a href=".route('setting.edit',$data->id_setting)."><button class='btn btn-xs btn-primary'> <i class='fa fa-edit'> </i> Edit  </button> </a>";
	      })

	      ->make(true);
    }
}
