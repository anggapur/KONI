<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = "event";
	protected $primaryKey = 'id_event';
	public $timestamps = false;
	public function getPrestasi()
	{
		return $this->hasMany('App\Prestasi','event_id','id_event');
	}
}
