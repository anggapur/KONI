<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_Atlet extends Model
{
    protected $table = "detail_atlet";
	protected $primaryKey = 'id_detail';
	public $timestamps = false;
}
