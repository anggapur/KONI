<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master_Atlet extends Model
{
    protected $table = "master_atlet";
	protected $primaryKey = 'id_atlet';
	public $timestamps = false;
}
