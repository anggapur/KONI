<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_Atlet_Event extends Model
{
    protected $table = "detail_atlet_event";
	protected $primaryKey = 'id_detail_event';
	protected $fillable = ['atlet_id','event_id'];
	public $timestamps = false;
}
