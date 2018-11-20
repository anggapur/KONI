<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomor_Pertandingan extends Model
{
    protected $table = "nomor_pertandingan";
    protected $fillable = ['cabor_id','ket_np'];
	protected $primaryKey = 'id_np';
	public $timestamps = false;
}

