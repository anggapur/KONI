<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Juara;
use Datatables;
class juaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $page = "Juara";
    public $viewFolder = "juara";
    public function index()
    {
        //
        $data['page'] = $this->page;
        return view($this->viewFolder.".index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page'] = $this->page;
        return view($this->viewFolder.".create",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        $ruleValidasi = [
            'ket_juara' => 'required',
        ];
        $pesanErrorCustom = [
            'required' => 'Kolom :attribute Harus diiisi.'
        ];
        $request->validate($ruleValidasi,$pesanErrorCustom);
        $query = Juara::create($data);
        if($query)
            return redirect('administrator/juara')->with(['status'=>'success' , 'message' => 'Berhasil Tambah Data Juara']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page'] = $this->page;
        $data['dataJuara'] = Juara::where('id_juara',$id)->first();
        return view($this->viewFolder.".edit",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token','_method');

        $ruleValidasi = [
            'ket_juara' => 'required',
            
        ];
        $pesanErrorCustom = [
            'required' => 'Kolom :attribute Harus diiisi.',
            'numeric' => 'Kolom :attribute Harus bernilai angka',
        ];
        $request->validate($ruleValidasi,$pesanErrorCustom);
        $query = Juara::where('id_juara',$id)->update($data);

        if($query)
            return redirect('administrator/juara')->with(['status'=>'success' , 'message' => 'Berhasil Update Data Juara']);
        else
            return redirect('administrator/juara');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query = Juara::where('id_juara',$id)->delete();
        if($query)
            return redirect('administrator/juara')->with(['status'=>'success' , 'message' => 'Berhasil <b>Hapus</b> Data Juara']);
    }
    public function getData()
    {
        $q = Juara::select('*');
        return Datatables::of($q)
                
                 ->addColumn('aksi', function($user) {
                    // <button class='btn btn-warning btn-xs'><i class='fa fa-eye'> </i> View</button>
                    return "
                            <a href='".route('juara.edit',$user->id_juara)."' class='btn btn-primary btn-xs'><i class='fa fa-edit'> </i> Edit</a>
                            <button onclick='hapus(`".$user->ket_juara."`,`".$user->id_juara."`)' class='btn btn-danger btn-xs'><i class='fa fa-trash'> </i> Delete</button>";
                })
                ->make(true);
    }
}
