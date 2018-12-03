<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use DB;
use Illuminate\Http\Request;
use App\Cabang_Olahraga;
use App\kabupaten;
use Yajra\Datatables\Datatables;
use App\Master_Atlet;
use App\Detail_Atlet;
use App\Nomor_Pertandingan;
use App\Foto;

class atletController extends Controller
{
    function index()
    {
        return view('atlet');
    }
    public function form_add()
    {
    	return View::make('add_master_atlet');
    }
    public function add_atlet()
    {
        $data['listKabupaten'] = Kabupaten::select('*')->get();
        // tes
    	$data['listCabangOlahraga'] = Cabang_Olahraga::select('*')->get();
        $data['listNoPertandingan'] = Nomor_Pertandingan::select('*')->get();
        $data['page'] = "Atlet";        
        $data['active'] = "Atlet";
    	return View('admin_atlet.add_atlet',$data);
    }
    public function view_atlet()
    {
        $data['page'] = "View Atlet";        
        $data['active'] = "View Atlet";
    	return View('admin_atlet.view_atlet',$data);
    }
    public function getData()
    {
        $data = Master_Atlet::select('nama_atlet','nama_cabor','no_kartu_tanda_anggota','jenis_kelamin','tempat_lahir','tgl_lahir','alamat','tinggi','berat','tgl_jadi_atlet','tgl_pensiun','status','id_atlet')
        	->leftJoin('cabang_olahraga','cabor_id','=','id_cabor')
            ->get();
        for($i=0;$i<count($data);$i++){
            if($data[$i]->status == 1)
                $data[$i]->status = 'Aktif';
            else
                $data[$i]->status = 'Tidak Aktif';
        }
      	return Datatables::of($data)
      		->addColumn('aksi', function($data){
        return "
            <button onclick='view(".$data->id_atlet.")' class='btn btn-xs btn-warning'> <i class='fa fa-eye'> </i> View </button>
            <a href=".route('edit_atlet',$data->id_atlet)."><button class='btn btn-xs btn-primary'> <i class='fa fa-edit'> </i> Edit  </button> </a>
      		<a href=".url('hapus_atlet/'.$data->id_atlet)."<button class='btn btn-xs btn-danger'> <i class='fa fa-trash'> </i> Hapus  </button></a>";
      		})
      	->make(true);
    }
    public function getDataAtlet(Request $Request){
        $data = Master_Atlet::select('nama_atlet','nama_cabor','no_kartu_tanda_anggota','jenis_kelamin','tempat_lahir','tgl_lahir','alamat','tinggi','berat','nama_kabupaten','tgl_jadi_atlet','tgl_pensiun','status','id_atlet','nama_foto')
            ->leftJoin('cabang_olahraga','cabor_id','=','id_cabor')
            ->leftJoin('kabupaten','id_kabupaten','=','kabupaten_id')
            ->leftJoin('foto','foto_id','=','id_foto')
            ->leftJoin('detail_atlet','atlet_id','=','id_atlet')
            ->where('id_atlet',$Request->id)
            ->first();
        if($data['status']==1){
            $data['status'] = 'Aktif';
        }else{
            $data['status'] = 'Tidak Aktif';
        }
        echo json_encode($data);
    }
    public function simpan(Request $request)
    {        
        //dd($request);
   		DB::beginTransaction();
   		try{
            $statement = DB::select("SHOW TABLE STATUS LIKE 'foto'");
            $nextId = $statement[0]->Auto_increment;
            //Foto atlet
            $file = $request->file('gambar');
            $ori_name = $file->getClientOriginalName();
            $fileName = $nextId.$ori_name;
            $size = $file->getSize();
            $type = $file->getClientOriginalExtension();
            $request->file('gambar')->move("public/upload/fotoAtlet", $fileName);
            $data_foto['nama_foto'] = $fileName;
            $data_foto['ukuran_foto'] = $size;
            $data_foto['tipe_foto'] = $type;
            $foto = Foto::create($data_foto);
            //Master atlet
            $data['foto_id'] = $foto->id_foto;
   			$data['nama_atlet'] = $request->nama_atlet;
	        $data['cabor_id'] = $request->cabor_id;
	        $data['no_kartu_tanda_anggota'] = $request->nkta;
	        $data['jenis_kelamin'] = $request->jenis_kelamin;
	        $data['tempat_lahir'] = $request->tempat_lahir;
	        $data['tgl_lahir'] = $request->tgl_lahir;
	        $data['alamat'] = $request->alamat;
	        $data['tinggi'] = $request->tinggi;
	        $data['berat'] = $request->berat;
	        //$data['kabupaten_id'] = $request->kabupaten_id;
            $data['kabupaten_id'] = 1;
	        $data['tgl_jadi_atlet'] = $request->tgl_jadi_atlet;
            $data['status'] = $request->status;
            if($request->status == 0)
	            $data['tgl_pensiun'] = $request->tgl_pensiun;
            else
                $data['tgl_pensiun'] = null;
            //detail_atlet            
   			$master_atlet = Master_Atlet::create($data);

            for ($i=0; $i < count($request->np_id); $i++) {
                $data_master['atlet_id'] = $master_atlet->id_atlet;
                $data_master['np_id'] = (int)$request->np_id[$i];
                //dd($data_master);
                $detail_atlet = Detail_Atlet::create($data_master);
                //dd($data_master);
            }
   			DB::commit();
            return redirect()->route('view_atlet')->with('status','success');
   		}catch (\Exception $e) {
   			DB::rollback();            
        	return $e;
    	}
    }
    public function edit_atlet($id)
    {
    	$data['listKabupaten'] = kabupaten::select('*')->get();
    	$data['listCabangOlahraga'] = Cabang_Olahraga::select('*')->get();
    	$data['data_atlet']=Master_Atlet::select('id_atlet','nama_atlet','cabor_id','no_kartu_tanda_anggota','jenis_kelamin','tempat_lahir','tgl_lahir','alamat','tinggi','berat','kabupaten_id','foto_id','tgl_jadi_atlet','tgl_pensiun','status','nama_foto','np_id','id_detail','id_foto','nama_foto')
            ->leftJoin('foto','foto_id','=','id_foto')
            ->leftJoin('detail_atlet','atlet_id','=','id_atlet')
            ->where ('id_atlet',$id)
            ->first();

        $data['atletNP'] = detail_atlet::select('np_id')->where('atlet_id',$id)->get();    


        $data['atletNP1'] = [];
        $i =0 ;
        foreach ($data['atletNP'] as $key) {
            $data['atletNP1'][$i] = $key->np_id;
            $i++;
        }        

        //dd($data['atletNP1']);

        $data['listNoPertandingan'] = Nomor_Pertandingan::select('*')->where('cabor_id',$data['data_atlet']->cabor_id)->get();
        $data['page'] = "Atlet";        
        $data['active'] = "Atlet";
    	return View('admin_atlet.edit_atlet',$data);
    }
    public function update_atlet(Request $request)
    {
        DB::beginTransaction();
        try{
            $data['id_atlet'] = $request->id_atlet;
            $data['id_detail'] = $request->id_detail;
            $data['id_foto'] = $request->id_foto;
            $data['nama_foto'] = $request->nama_foto;
            $data['nama_atlet'] = $request->nama_atlet;
            $data['cabor_id'] = $request->cabor_id;
            $data['no_kartu_tanda_anggota'] = $request->no_kartu_tanda_anggota;
            $data['jenis_kelamin'] = $request->jenis_kelamin;
            $data['tempat_lahir'] = $request->tempat_lahir;
            $data['tgl_lahir'] = $request->tgl_lahir;
            $data['alamat'] = $request->alamat;
            $data['tinggi'] = $request->tinggi;
            $data['berat'] = $request->berat;
            // $data['kabupaten_id'] = $request->kabupaten_id;
            $data['tgl_jadi_atlet'] = $request->tgl_jadi_atlet;
            if($request->status == 1)
                $data['tgl_pensiun'] = $request->tgl_pensiun;
            else
                $data['tgl_pensiun'] = null;
            $data['status'] = $request->status;
            $data['np_id'] = $request->np_id;
            $update=Master_Atlet::select('*')->where('id_atlet',$request->id_atlet)
            ->update([
                'nama_atlet' => $data['nama_atlet'],
                'cabor_id' => $data['cabor_id'],
                'no_kartu_tanda_anggota' => $data['no_kartu_tanda_anggota'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'tempat_lahir' => $data['tempat_lahir'],
                'tgl_lahir' => $data['tgl_lahir'],
                'alamat' => $data['alamat'],
                'tinggi' => $data['tinggi'],
                'berat' => $data['berat'],
                // 'kabupaten_id' => $data['kabupaten_id'],
                'tgl_jadi_atlet' => $data['tgl_jadi_atlet'],
                'tgl_pensiun' => $data['tgl_pensiun'],
                'status' => $data['status']
                ]);

            $atletNP = Detail_Atlet::select('np_id')->where('atlet_id',$request->id_atlet)->get();
            //dd($request->np_id);
            //dd($atletNP);
            for ($i=0; $i < count($request->np_id) ; $i++) { 
                for ($j=0; $j < count($atletNP); $j++) { 
                    if($request->np_id[$i] == $atletNP[$j]->np_id){
                        $atletNP[$j]->np_id = null;
                        //$request->np_id[$i] = null;
                    }else{
                        $data_master['atlet_id'] = $request->id_atlet;
                        $data_master['np_id'] = $request->np_id[$i];
                        //dd($data_master);
                        $detail_atlet = Detail_Atlet::create($data_master);
                    }
                }
            }

            //dd($request->np_id);

            for ($j=0; $j < count($atletNP); $j++){
                if($atletNP[$j]->np_id != null){
                    $detail = Detail_Atlet::select('*')->where('atlet_id',$request->id_atlet)->where('np_id',$atletNP[$j]->np_id)->delete();
                    //dd($detail);
                }
            }            

            if($request->file('gambar') == ""){} 
            else
            {
                $IdFoto = $request->id_foto;
                File::delete('public/upload/fotoAtlet/'.$request->nama_foto);
                $file       = $request->file('gambar');
                $ori_name = $file->getClientOriginalName();
                $fileName = $IdFoto.$ori_name;
                $size = $file->getSize();
                $type = $file->getClientOriginalExtension();
                $request->file('gambar')->move("public/upload/fotoAtlet", $fileName);
                $update_foto = Foto::select('*')->where('id_foto',$request->id_foto)
                ->update([
                    'nama_foto' => $fileName,
                    'ukuran_foto' => $size,
                    'tipe_foto' => $type
                ]);
            }
            DB::commit();
            return redirect()->route('view_atlet')->with('status','edited');  
        }catch(\Exception $e) {
            DB::rollback();
            return $e;
        }         
    }
    public function hapus_atlet($id)
    {
        DB::beginTransaction();
        try{   
            $data=Master_Atlet::select('id_atlet','nama_atlet','cabor_id','no_kartu_tanda_anggota','jenis_kelamin','tempat_lahir','tgl_lahir','alamat','tinggi','berat','kabupaten_id','foto_id','tgl_jadi_atlet','tgl_pensiun','status','nama_foto','np_id','id_detail','id_foto','nama_foto')
            ->leftJoin('foto','foto_id','=','id_foto')
            ->leftJoin('detail_atlet','atlet_id','=','id_atlet')
            ->where ('id_atlet',$id)
            ->first();
            File::delete('public/upload/fotoAtlet/'.$data->nama_foto);
            $query_master=Master_Atlet::where('id_atlet',$id)->delete();
            $query_detail=Detail_Atlet::where('id_detail',$data->id_detail)->delete();
            $query_foto=Foto::where('id_foto',$data->id_foto)->delete();
            DB::commit();
            return redirect('view_atlet')->with('status','deleted');
        }catch(\Exception $e) {
            DB::rollback();
            return $e;
        }  
    }
}
