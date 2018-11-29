<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Juara extends Model
{
    protected $table = "juara";
	protected $primaryKey = 'id_juara';
	protected $fillable = ['ket_juara'];
	public $timestamps = false;
}
