<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = "prestasi";
	protected $primaryKey = 'id_prestasi';
	public $timestamps = true;
	const CREATED_AT = 'create_at';
	const UPDATED_AT = 'create_at';
}
