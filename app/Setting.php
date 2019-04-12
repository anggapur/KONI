<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = "setting";
	protected $primaryKey = 'id_setting';
	protected $fillable = ['attr','deskripsi','type','value','status'];	
}
