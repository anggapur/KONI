<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kabupaten;
use App\Wasit;
use App\Cabang_Olahraga;
class wasitController extends Controller
{
    public function index()
    {
    	$data['datakabupaten'] = Kabupaten::all();
    	$data['cabang_olahraga'] = Cabang_Olahraga::all();
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
    	$data['cabor_id'] = $request->cabor_id;
    	$query = Wasit::create($data);
    	if($query)
    		return redirect('tampilWasit')->with(['status' => 'success' , 'message' => 'Berhasil Simpan Data']);
    	else
    		echo "Gagal";

    }
    public function tampilData()
    {
    	$data['Wasit']= Wasit::leftJoin('cabang_olahraga','wasit.cabor_id','=','cabang_olahraga.id_cabor')->get();
    	return view('wasit.tampilData',$data);
    }
    public function editdata($id)
    {
    	$data['datakabupaten'] = Kabupaten::all();
    	$data['Wasit']= Wasit::where('id_wasit',$id)->first();
    	return view('wasit.editwasit',$data);
    }
    public function update(Request $request)
    {
    	// return $request->all();
    	$data['nama_wasit'] = $request->nama_wasit;
    	$data['no_kartu_anggota'] = $request->no_kartu_anggota;
    	$data['jenis_kelamin'] = $request->jenis_kelamin;
    	$data['tempat_lahir'] = $request->tempat_lahir;
    	$data['tgl_lahir'] = $request->tgl_lahir;
    	$data['alamat'] = $request->alamat;
    	$data['kabupaten_id'] = $request->kabupaten_id;
    	$query = Wasit::where('id_wasit', $request->id_wasit)->update($data);
    	if($query)
    		return redirect('tampilWasit')->with(['status' => 'success' , 'message' => 'Berhasil Update Data']);
    	else
    		echo "Gagal";
    }
}
