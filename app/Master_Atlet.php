<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master_Atlet extends Model
{
    protected $table = "master_atlet";
	protected $primaryKey = 'id_atlet';
	protected $fillable = [
		'nama_atlet',
		'cabor_id',
		'no_kartu_tanda_anggota',
		'jenis_kelamin',
		'tempat_lahir',
		'tgl_lahir',
		'alamat',
		'tinggi',
		'berat',
		'kabupaten_id',
		'foto_id',
		'tgl_jadi_atlet',
		'tgl_pensiun',
		'status'
	];
	public $timestamps = false;

	public function getPrestasi()
	{
		return $this->hasMany('App\Prestasi','atlet_id','id_atlet');
	}
}
