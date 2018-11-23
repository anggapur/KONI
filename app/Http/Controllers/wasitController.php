<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kabupaten;
use App\Wasit;
class wasitController extends Controller
{
    public function index()
    {
    	$data['datakabupaten'] = Kabupaten::all();
    	return view('wasit.wasit',$data);
    	
    }
    public function simpan(Request $request)
    {
    	$data['nama_wasit'] = $request->nama_wasit;
    	$data['no_kartu_anggota'] = $request->no_kartu_anggota;
    	$data['jenis_kelamin'] = $request->jenis_kelamin;
    	$data['tempat_lahir'] = $request->tempat_lahir;
    	$data['tgl_lahir'] = $request->tgl_lahir;
    	$data['alamat'] = $request->alamat;
    	$data['kabupaten_id'] = $request->kabupaten_id;
    	$query = Wasit::create($data);
    	if($query)
    		echo "Berhasil";
    	else
    		echo "Gagal";

    }
}
