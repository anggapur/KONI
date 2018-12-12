<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tingkat_Event extends Model
{
    protected $table = "tingkat_event";
	protected $primaryKey = 'id_tingkat';
	public $timestamps = false;
}
