<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Cabang_Olahraga;

class importDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $page = "Import Data";
    public $viewPage = "importData";
    public function index()
    {
        //
        $data['page'] = $this->page;
        return view($this->viewPage.".index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $berhasil = "";
        $gagal = "";
        $updateCount = 0;
        $insertCount = 0;
        $errorsMessage = "";
        if($request->hasFile('file_data')){
            $path = $request->file('file_data')->getRealPath();
            $data = Excel::load($path, function($reader){})->get();
            if(!empty($data) && $data->count()){
                return $this->generateDataAtlet($data);
            }
        }
    }
    public function generateDataAtlet($data)
    {
        $dataList = [];
        foreach ($data as $key => $value) {
            $tempData['nama_atlet'] = $value->nama;   
            //cabor
            $cabor_id = Cabang_Olahraga::where('nama_cabor',$value->cabor);
            if($cabor_id->get()->count() > 0)
                $cabor_id = $cabor_id->first()->id_cabor; 
            $tempData['cabor_id'] = $cabor_id;

            $tempData['no_kartu_tanda_anggota'] = $value->kta;   

            $tempData['jenis_kelamin'] = $value->jk;   
            $tempData['tempat_lahir'] = $value->tempat_lahir;   

            $tgl_lahir
            $tempData['tgl_lahir'] = $value->tgl_lahir;   
            $tempData['alamat'] = $value->alamat;   
            $tempData['tinggi'] = $value->tinggi;   
            $tempData['berat'] = $value->berat;   
            $tempData['kabupaten_id'] = "1";   
            $tempData['foto_id'] = "1";   
            $tempData['tgl_jadi_atlet'] = $value->tgl_jadi_atlet;   
            $tempData['tgl_pensiun'] = $value->tgl_pensiun;   
            $tempData['status'] = "0";  
            array_push($dataList, $tempData); 
        }
        return $dataList;
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
    }
}
