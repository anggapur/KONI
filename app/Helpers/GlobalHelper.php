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
		$data['prestasi_terbaru'] = Prestasi::select('nama_atlet','nama_prestasi','nama_cabor','ket_np','waktu','nama_foto')
										->leftJoin('cabang_olahraga','id_cabor','=','cabor_id')
										->leftJoin('master_atlet','id_atlet','=','atlet_id')
										->leftJoin('foto','id_foto','=','foto_id')
										->leftJoin('nomor_pertandingan','id_np','=','np_id')
										->limit($jml)
										->orderBy('waktu','DESC')
										->get();
		return $data;	
	}
}
