<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kontingen extends Model
{
    protected $table = "kontingen";
	protected $primaryKey = 'id_kontingen';
	public $timestamps = false;
}
