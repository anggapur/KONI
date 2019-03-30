<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;
use Yajra\Datatables\Datatables;

class LevelController extends Controller
{
    //
    public $page = "Level";
    public $viewFolder = "Level";
    public function index()
    {        
        $data['page'] = $this->page;
        return view($this->viewFolder.".index",$data);
    }

    public function create()
    {        
        $data['page'] = $this->page;
        return view($this->viewFolder.".create",$data);
    }

    public function edit($id)
    {        
        $data['page'] = $this->page;        
        $data['data'] = Level::select('*')->where('id_level',$id)->first();
        return view($this->viewFolder.".edit",$data);
    }

    public function getData()
    {
        $q = Level::select('*');
        return Datatables::of($q)
             ->addColumn('aksi', function($user) {
                return "
                        <a href='".route('level.edit',$user->id_level)."' class='btn btn-primary btn-xs'><i class='fa fa-edit'> </i> Edit</a>
                        <button onclick='hapus(`".$user->nama_level."`,`".$user->id_level."`)' class='btn btn-danger btn-xs'><i class='fa fa-trash'> </i> Delete</button>";
           })
            ->make(true);
    }

    public function store(request $request){
    	$ruleValidasi = [
            'nama_level' => 'required',
            'keterangan' => 'required',
        ];
        $pesanErrorCustom = [
            'required' => 'Kolom :attribute Harus diisi.'
        ];
        $request->validate($ruleValidasi,$pesanErrorCustom);
    	$data = $request->except('_token');
    	$query = Level::create($data);
    	if($query)
            return redirect('level')->with(['status'=>'success' , 'message' => 'Berhasil Tambah Data Level']);
    }

    public function update(request $request, $id){
    	$ruleValidasi = [
            'nama_level' => 'required',
            'keterangan' => 'required',
        ];
        $pesanErrorCustom = [
            'required' => 'Kolom :attribute Harus diisi.'
        ];
        $request->validate($ruleValidasi,$pesanErrorCustom);
    	$data = $request->except('_token','_method');
    	$query = Level::where('id_level',$id)->update($data);
    	if($query)
            return redirect('level')->with(['status'=>'success' , 'message' => 'Berhasil Update Data Level']);
    }

    public function destroy($id){
        $query = Level::where('id_level',$id)->delete();
        if($query)
            return redirect('level')->with(['status'=>'success' , 'message' => 'Berhasil Hapus Data Level']);   
    }    
}
