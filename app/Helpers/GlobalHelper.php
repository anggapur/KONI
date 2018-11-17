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

class GlobalHelper{
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
		$data['prestasi_terbaru'] = Prestasi::select('nama_atlet','nama_prestasi','nama_cabor','ket_np','waktu','nama_foto','nama_event')
										->leftJoin('cabang_olahraga','id_cabor','=','cabor_id')
										->leftJoin('master_atlet','id_atlet','=','atlet_id')
										->leftJoin('foto','id_foto','=','foto_id')
										->leftJoin('nomor_pertandingan','id_np','=','np_id')
										->leftJoin('event','id_event','=','event_id')
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
}
