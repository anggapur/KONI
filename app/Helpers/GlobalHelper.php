<?php
namespace App\Helpers;

use DB;
use App\Master_Atlet;
use App\Wasit;
use App\Kontingen;

class GlobalHelper{
	public static function getCountData(){
		$data = [];
		$data['jml_atlet'] = Master_Atlet::select('id_atlet')->count();
		$data['jml_wasit'] = Wasit::select('id_wasit')->count();
		$data['jml_manager'] = Kontingen::select('id_kontingen')->where('id_jabatan','1')->count();
		$data['jml_pelatih'] = Kontingen::select('id_kontingen')->where('id_jabatan','2')->count();
		$data['jml_teknisi'] = Kontingen::select('id_kontingen')->where('id_jabatan','3')->count();
		$data['jml_official'] = Kontingen::select('id_kontingen')->where('id_jabatan','4')->count();
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
									->where('id_jabatan','1')
									->where('jenis_kelamin','P')
									->count();
			$data['laki-laki'] = Kontingen::select('id_kontingen')
									->where('id_jabatan','1')
									->where('jenis_kelamin','L')
									->count();
		}
		else if($jenis == 'pelatih'){
			$data['perempuan'] = Kontingen::select('id_kontingen')
									->where('id_jabatan','2')
									->where('jenis_kelamin','P')
									->count();
			$data['laki-laki'] = Kontingen::select('id_kontingen')
									->where('id_jabatan','2')
									->where('jenis_kelamin','L')
									->count();
		}
		else if($jenis == 'teknisi'){
			$data['perempuan'] = Kontingen::select('id_kontingen')
									->where('id_jabatan','3')
									->where('jenis_kelamin','L')
									->count();
			$data['laki-laki'] = Kontingen::select('id_kontingen')
									->where('id_jabatan','3')
									->where('jenis_kelamin','P')
									->count();
		}
		else if($jenis == 'official'){
			$data['perempuan'] = Kontingen::select('id_kontingen')
									->where('id_jabatan','4')
									->where('jenis_kelamin','L')
									->count();
			$data['laki-laki'] = Kontingen::select('id_kontingen')
									->where('id_jabatan','4')
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
}
