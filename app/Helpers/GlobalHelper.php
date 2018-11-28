<?php
namespace App\Helpers;

use DB;
use App\Master_Atlet;
use App\Wasit;
use App\Kontingen;
use App\Cabang_Olahraga;
use App\Nomor_Pertandingan;
use App\Event;
use App\Prestasi;
use App\Rekor_Atlet;
use App\Detail_Atlet;
use App\rentangUmur;
use Request;

class GlobalHelper{

	public static function segment($i,$word) {
            
      if (in_array(Request::segment($i),$word))
      	return "active";
      else
      	return "boom";
    }

	public static function getCountData(){
		// $data = [];
		$data['jml_atlet'] = Master_Atlet::select('id_atlet')->count();
		$data['jml_wasit'] = Wasit::select('id_wasit')->count();
		$data['jml_manager'] = Kontingen::select('id_kontingen')->where('jabatan_id','1')->count();
		$data['jml_pelatih'] = Kontingen::select('id_kontingen')->where('jabatan_id','2')->count();
		$data['jml_teknisi'] = Kontingen::select('id_kontingen')->where('jabatan_id','3')->count();
		$data['jml_official'] = Kontingen::select('id_kontingen')->where('jabatan_id','4')->count();
		return $data;
	}

	public static function getCountGender($jenis){
		$data = [];
		if($jenis == 'atlet'){
			$data['perempuan'] = Master_Atlet::select('id_atlet')->where('jenis_kelamin','P')->count();
			$data['laki-laki'] = Master_Atlet::select('id_atlet')->where('jenis_kelamin','L')->count();
		}
		else if($jenis == 'wasit'){
			$data['perempuan'] = Wasit::select('id_wasit')->where('jenis_kelamin','P')->count();
			$data['laki-laki'] = Wasit::select('id_wasit')->where('jenis_kelamin','L')->count();
		}
		else if($jenis == 'manager'){
			$data['perempuan'] = Kontingen::select('id_kontingen')
									->where('jabatan_id','1')
									->where('jenis_kelamin','P')
									->count();
			$data['laki-laki'] = Kontingen::select('id_kontingen')
									->where('jabatan_id','1')
									->where('jenis_kelamin','L')
									->count();
		}
		else if($jenis == 'pelatih'){
			$data['perempuan'] = Kontingen::select('id_kontingen')
									->where('jabatan_id','2')
									->where('jenis_kelamin','P')
									->count();
			$data['laki-laki'] = Kontingen::select('id_kontingen')
									->where('jabatan_id','2')
									->where('jenis_kelamin','L')
									->count();
		}
		else if($jenis == 'teknisi'){
			$data['perempuan'] = Kontingen::select('id_kontingen')
									->where('jabatan_id','3')
									->where('jenis_kelamin','L')
									->count();
			$data['laki-laki'] = Kontingen::select('id_kontingen')
									->where('jabatan_id','3')
									->where('jenis_kelamin','P')
									->count();
		}
		else if($jenis == 'official'){
			$data['perempuan'] = Kontingen::select('id_kontingen')
									->where('jabatan_id','4')
									->where('jenis_kelamin','L')
									->count();
			$data['laki-laki'] = Kontingen::select('id_kontingen')
									->where('jabatan_id','4')
									->where('jenis_kelamin','P')
									->count();
		}
		return $data;
	}

	public static function getStatusAtlet(){
		$data = [];
		$data['atlet_aktif'] = Master_Atlet::select('id_atlet')->where('status','1')->count();
		$data['atlet_tidak_aktif'] = Master_Atlet::select('id_atlet')->where('status','0')->count();
		return $data;
	}


	public static function getCountCabor(){
		$data = [];
		$data['jml_cabor'] = Cabang_Olahraga::select('id_cabor')->count();
		return $data;	
	}

	public static function getCountNP(){
		$data = [];
		$data['jml_np'] = Nomor_Pertandingan::select('id_np')->count();
		return $data;
	}

	public static function getCountEvent(){
		$data = [];
		$data['jml_event'] = Event::select('id_event')->count();
		return $data;
	}

	public static function getCountPrestasi(){
		$data = [];
		$data['jml_prestasi'] = Prestasi::select('id_prestasi')->count();
		return $data;
	}

	public static function getCountRekor(){
		$data = [];
		$data['jml_rekor'] = Rekor_Atlet::select('id_rekor')->count();
		return $data;
	}

	public static function getPrestasiTerbaru($jml){
		$data = [];
		$data['prestasi_terbaru'] = Prestasi::select('id_atlet','nama_atlet','ket_juara','nama_cabor','ket_np','waktu','nama_foto','nama_event')
										->leftJoin('cabang_olahraga','id_cabor','=','cabor_id')
										->leftJoin('master_atlet','id_atlet','=','atlet_id')
										->leftJoin('foto','id_foto','=','foto_id')
										->leftJoin('nomor_pertandingan','id_np','=','np_id')
										->leftJoin('event','id_event','=','event_id')
										->leftJoin('juara','id_juara','=','juara_id')
										->leftJoin('medali','id_medali','=','medali_id')
										->limit($jml)
										->orderBy('waktu','DESC')
										->get();
		return $data;	
	}

	public static function getPrestasiByGender(){
		$data = [];
		$data['laki-laki'] = Prestasi::select('id_prestasi')
								->leftJoin('master_atlet','id_atlet','=','atlet_id')
								->where('jenis_kelamin','L')
								->count();
		$data['perempuan'] = Prestasi::select('id_prestasi')
								->leftJoin('master_atlet','id_atlet','=','atlet_id')
								->where('jenis_kelamin','P')
								->count();
		return $data;
	}

	public static function getPrestasiByCabor(){
		$data = [];
		$cabor = Cabang_Olahraga::select('nama_cabor')->get();
		foreach ($cabor as $cabor) {
			$data[$cabor->nama_cabor] = Prestasi::select('id_prestasi')
										->leftJoin('cabang_olahraga','id_cabor','=','cabor_id')
										->where('nama_cabor',$cabor->nama_cabor)
										->count();
		}
		return $data;
	}

	public static function getPrestasiByNP(){
		$data = [];
		$cabor = Cabang_Olahraga::select('id_cabor','nama_cabor')->get();
		foreach ($cabor as $cabor) {
			$np = Nomor_Pertandingan::select('ket_np')->where('cabor_id',$cabor->id_cabor)->get();
			foreach ($np as $np) {
				$data[$cabor->nama_cabor][$np->ket_np] =
						Prestasi::select('id_prestasi')
							->leftJoin('nomor_pertandingan','id_np','=','np_id')
							->where('ket_np',$np->ket_np)
							->where('prestasi.cabor_id',$cabor->id_cabor)
							->count();
			}
		}
		return $data;
	}

	public static function getAtletByCabor(){
		$data = [];
		$cabor = Cabang_Olahraga::select('nama_cabor')->get();
		foreach ($cabor as $cabor) {
			$data[$cabor->nama_cabor] = Master_Atlet::select('id_atlet')
										->leftJoin('cabang_olahraga','id_cabor','=','cabor_id')
										->where('nama_cabor',$cabor->nama_cabor)
										->count();
		}
		return $data;	
	}

	public static function getAtletByNP(){
		$data = [];
		$cabor = Cabang_Olahraga::select('id_cabor','nama_cabor')->get();
		foreach ($cabor as $cabor) {
			$np = Nomor_Pertandingan::select('ket_np')->where('cabor_id',$cabor->id_cabor)->get();
			foreach ($np as $np) {
				$data[$cabor->nama_cabor][$np->ket_np] =
						Master_Atlet::select('id_atlet')
							->leftJoin('detail_atlet','id_atlet','=','atlet_id')
							->leftJoin('nomor_pertandingan','id_np','=','np_id')
							->where('ket_np',$np->ket_np)
							->where('master_atlet.cabor_id',$cabor->id_cabor)
							->count();
			}
		}	
		return $data;
	}

	public static function getPrestasiByEvent(){
		$data = [];
		$event = Event::select('id_event','nama_event')->get();
		foreach ($event as $event) {
			$data[$event->nama_event] = Prestasi::select('id_prestasi')
											->where('event_id',$event->id_event)
											->count();
		}
		return $data;
	}

	public static function getPrestasiByGenderOnEvent($id_event){
		$data = [];
		$data['laki-laki'] = Prestasi::select('id_prestasi')
								->leftJoin('master_atlet','id_atlet','=','atlet_id')
								->where('jenis_kelamin','L')
								->where('event_id',$id_event)
								->count();
		$data['perempuan'] = Prestasi::select('id_prestasi')
								->leftJoin('master_atlet','id_atlet','=','atlet_id')
								->where('jenis_kelamin','P')
								->where('event_id',$id_event)
								->count();
		return $data;
	}

	public static function getPrestasiByCaborOnEvent($id_event){
		$data = [];
		$cabor = Cabang_Olahraga::select('nama_cabor')->get();
		foreach ($cabor as $cabor) {
			$data[$cabor->nama_cabor] = Prestasi::select('id_prestasi')
										->leftJoin('cabang_olahraga','id_cabor','=','cabor_id')
										->where('nama_cabor',$cabor->nama_cabor)
										->where('event_id',$id_event)
										->count();
		}
		return $data;
	}

	public static function getPrestasiByNPOnEvent($id_event){
		$data = [];
		$cabor = Cabang_Olahraga::select('id_cabor','nama_cabor')->get();
		foreach ($cabor as $cabor) {
			$np = Nomor_Pertandingan::select('ket_np')->where('cabor_id',$cabor->id_cabor)->get();
			foreach ($np as $np) {
				$data[$cabor->nama_cabor][$np->ket_np] =
						Prestasi::select('id_prestasi')
							->leftJoin('nomor_pertandingan','id_np','=','np_id')
							->where('ket_np',$np->ket_np)
							->where('prestasi.cabor_id',$cabor->id_cabor)
							->where('event_id',$id_event)
							->count();
			}
		}
		return $data;
	}

	public static function getAtletByJenisKelaminAndUmurandCabor()
	{
		$query = Cabang_Olahraga::with(['getAtlet' => function($q){
            $q->select('*',DB::raw('(year(curdate())-year(tgl_lahir)) as age'));
        }])->get();

        $data = [];
        foreach ($query as $key => $value) {
            $datas[0] = $value->nama_cabor;
            $datas[1] = collect($value->getAtlet)->where('age','<=',10)->where('jenis_kelamin','P')->count(); //Perempuan,anak
            $datas[2] = collect($value->getAtlet)->where('age','>',10)->where('age','<=',17)->where('jenis_kelamin','P')->count(); //Perempuan,remaja
            $datas[3] = collect($value->getAtlet)->where('age','>',17)->where('jenis_kelamin','P')->count(); //Perempuan,dewasa
            $datas[4] = collect($value->getAtlet)->where('age','<=',10)->where('jenis_kelamin','L')->count();//laki,anak
            $datas[5] = collect($value->getAtlet)->where('age','>',10)->where('age','<=',17)->where('jenis_kelamin','L')->count();//laki,remaja
            $datas[6] = collect($value->getAtlet)->where('age','>',17)->where('jenis_kelamin','L')->count();//laki,dewasa
            array_push($data, $datas);
        }
        return $data;
	}

	public static function getAtletByJenisKelaminAndUmur()
	{
		$i = 0;
		$query = Master_Atlet::select('*',DB::raw('(year(curdate())-year(tgl_lahir)) as age'))->get();
		$queryData = rentangUmur::orderBy('umur_awal','ASC')->get();
        $data = [];

        $datas[$i++] = "Perempuan";
        foreach ($queryData as $key => $value) {
        	$datas[$i++] = collect($query)->where('age','>=',$value->umur_awal)
        					->where('age','<=',$value->umur_akhir)
        					->where('jenis_kelamin','P')->count();
        }
        array_push($data, $datas);
        
        $i = 0;
        $datas[$i++] = "Laki - Laki";
        foreach ($queryData as $key => $value) {
        	$datas[$i++] = collect($query)->where('age','>=',$value->umur_awal)
        					->where('age','<=',$value->umur_akhir)
        					->where('jenis_kelamin','L')->count();
        }
        array_push($data, $datas);
        
        return $data;
	}

	public static function getWasitByJenisKelaminAndUmur()
	{
		$query = Wasit::select('*',DB::raw('(year(curdate())-year(tgl_lahir)) as age'))->get();
        $data = [];
        $datas[0] = "Perempuan";
        $datas[1] = collect($query)->where('age','<=',10)->where('jenis_kelamin','P')->count(); //Perempuan,anak
        $datas[2] = collect($query)->where('age','>',10)->where('age','<=',17)->where('jenis_kelamin','P')->count(); //Perempuan,remaja
        $datas[3] = collect($query)->where('age','>',17)->where('jenis_kelamin','P')->count(); //Perempuan,dewasa
        array_push($data, $datas);
        $datas[0] = "Laki - Laki";
        $datas[1] = collect($query)->where('age','<=',10)->where('jenis_kelamin','L')->count();//laki,anak
        $datas[2] = collect($query)->where('age','>',10)->where('age','<=',17)->where('jenis_kelamin','L')->count();//laki,remaja
        $datas[3] = collect($query)->where('age','>',17)->where('jenis_kelamin','L')->count();//laki,dewasa
        array_push($data, $datas);
        
        return $data;
	}

	public static function getPelatihByJenisKelaminAndUmur()
	{
		$query = Kontingen::select('*',DB::raw('(year(curdate())-year(tgl_lahir)) as age'))->where('jabatan_id',2)->get();
        $data = [];
        $datas[0] = "Perempuan";
        $datas[1] = collect($query)->where('age','<=',10)->where('jenis_kelamin','P')->count(); //Perempuan,anak
        $datas[2] = collect($query)->where('age','>',10)->where('age','<=',17)->where('jenis_kelamin','P')->count(); //Perempuan,remaja
        $datas[3] = collect($query)->where('age','>',17)->where('jenis_kelamin','P')->count(); //Perempuan,dewasa
        array_push($data, $datas);
        $datas[0] = "Laki - Laki";
        $datas[1] = collect($query)->where('age','<=',10)->where('jenis_kelamin','L')->count();//laki,anak
        $datas[2] = collect($query)->where('age','>',10)->where('age','<=',17)->where('jenis_kelamin','L')->count();//laki,remaja
        $datas[3] = collect($query)->where('age','>',17)->where('jenis_kelamin','L')->count();//laki,dewasa
        array_push($data, $datas);
        
        return $data;
	}

	public static function getPelatihByCabor(){
		$data = [];
		$cabor = Cabang_Olahraga::select('nama_cabor')->get();
		foreach ($cabor as $cabor) {
			$data[$cabor->nama_cabor] = Kontingen::select('id_atlet')
										->leftJoin('cabang_olahraga','id_cabor','=','cabor_id')
										->where('jabatan_id',2)
										->where('nama_cabor',$cabor->nama_cabor)
										->count();
		}
		return $data;	
	}

	public static function getWasitByCabor(){
		$data = [];
		$cabor = Cabang_Olahraga::select('nama_cabor')->get();
		foreach ($cabor as $cabor) {
			$data[$cabor->nama_cabor] = Wasit::select('id_prestasi')
										->leftJoin('cabang_olahraga','id_cabor','=','cabor_id')
										->where('nama_cabor',$cabor->nama_cabor)
										->count();
		}
		return $data;
	}

	public static function normalize($param)
	{
		//digunakan untuk membuat huruf ke kecil dan menghilangkan spasi
		$param = strtolower($param);
		$param = str_replace(" ","-",$param);
		return $param;
	}
	public static function getImages($url,$image)
	{
		return $url."/".$image;
	}
}

