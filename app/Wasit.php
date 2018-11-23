<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wasit extends Model
{
    protected $table = "wasit";
    protected $fillable = ['nama_wasit','no_kartu_anggota','jenis_kelamin','tempat_lahir','tgl_lahir','alamat','kabupaten_id'];
	protected $primaryKey = 'id_wasit';
	public $timestamps = false;
}
