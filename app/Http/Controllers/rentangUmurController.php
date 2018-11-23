<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\rentangUmur;
use Validator;
use Datatables;
class rentangUmurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $page = "Manajemen Rentang Umur";
    public $viewFolder = "rentangUmur";
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
            'jenis_umur' => 'required',
            'umur_awal' => 'required|numeric',
            'umur_akhir' => 'required|numeric',
        ];
        $pesanErrorCustom = [
            'required' => 'Kolom :attribute Harus diiisi.',
            'numeric' => 'Kolom :attribute Harus bernilai angka',
        ];
        $request->validate($ruleValidasi,$pesanErrorCustom);
        $query = rentangUmur::create($data);
        if($query)
            return redirect('administrator/rentangUmur')->with(['status'=>'success' , 'message' => 'Berhasil Tambah Data Rentang Umur']);
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
        //
        $data['page'] = $this->page;
        $data['dataRentangUmur'] = rentangUmur::where('id',$id)->first();
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
        //
        $data = $request->except('_token','_method');

        $ruleValidasi = [
            'jenis_umur' => 'required',
            'umur_awal' => 'required|numeric',
            'umur_akhir' => 'required|numeric',
        ];
        $pesanErrorCustom = [
            'required' => 'Kolom :attribute Harus diiisi.',
            'numeric' => 'Kolom :attribute Harus bernilai angka',
        ];
        $request->validate($ruleValidasi,$pesanErrorCustom);
        $query = rentangUmur::where('id',$id)->update($data);
        if($query)
            return redirect('administrator/rentangUmur')->with(['status'=>'success' , 'message' => 'Berhasil Update Data Rentang Umur']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $query = rentangUmur::where('id',$id)->delete();
        if($query)
            return redirect('administrator/rentangUmur')->with(['status'=>'success' , 'message' => 'Berhasil <b>Hapus</b> Data Rentang Umur']);

    }
    public function getData()
    {
        $q = rentangUmur::select('*');
        return Datatables::of($q)
                 ->addColumn('rentang', function($user) {
                    return $user->umur_awal." - ".$user->umur_akhir." tahun";
                })
                 ->addColumn('aksi', function($user) {
                    // <button class='btn btn-warning btn-xs'><i class='fa fa-eye'> </i> View</button>
                    return "
                            <a href='".route('rentangUmur.edit',$user->id)."' class='btn btn-primary btn-xs'><i class='fa fa-edit'> </i> Edit</a>
                            <button onclick='hapus(`".$user->jenis_umur."`,`".$user->id."`)' class='btn btn-danger btn-xs'><i class='fa fa-trash'> </i> Delete</button>";
                })
                ->make(true);
    }
}
