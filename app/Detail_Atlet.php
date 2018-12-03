<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_Atlet extends Model
{
    protected $table = "detail_atlet";
	protected $primaryKey = 'id_detail';
	protected $fillable = ['atlet_id','np_id'];
	public $timestamps = false;
}
