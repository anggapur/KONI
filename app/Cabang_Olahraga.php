<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabang_Olahraga extends Model
{
    protected $table = "cabang_olahraga";
	protected $primaryKey = 'id_cabor';
	public $timestamps = false;
}
