<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rentangUmur extends Model
{
    //
    protected $table = "rentang_umur";
    protected $fillable = ['jenis_umur','umur_awal','umur_akhir'];
}
