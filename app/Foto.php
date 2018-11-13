<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = "foto";
	protected $primaryKey = 'id_foto';
	public $timestamps = false;
}
