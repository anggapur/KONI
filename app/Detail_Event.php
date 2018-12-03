<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_Event extends Model
{
    protected $table = "detail_event";
	protected $primaryKey = 'id_detail';
	public $timestamps = false;
}
