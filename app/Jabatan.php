<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = "jabatan";
	protected $primaryKey = 'id_jabatan';
	public $timestamps = false;
}
