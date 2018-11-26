<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master_Atlet extends Model
{
    protected $table = "master_atlet";
	protected $primaryKey = 'id_atlet';
	public $timestamps = false;

	public function getPrestasi()
	{
		return $this->hasMany('App\Prestasi','atlet_id','id_atlet');
	}
}
