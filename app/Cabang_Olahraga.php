<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabang_Olahraga extends Model
{
    protected $table = "cabang_olahraga";
	protected $primaryKey = 'id_cabor';
	public $timestamps = false;

	public function getAtlet()
	{
		return $this->hasMany('App\Master_Atlet','cabor_id','id_cabor');
	}

	public function toDetailEvent()
	{
		return $this->hasOne('App\Detail_Event','cabor_id','id_cabor');
	}
}
