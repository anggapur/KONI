<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medali extends Model
{
    protected $table = "medali";
	protected $primaryKey = 'id_medali';
	protected $fillable = ['nama_medali'];
	public $timestamps = false;
}
