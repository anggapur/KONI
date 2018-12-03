<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekor_Atlet extends Model
{
    protected $table = "rekor_atlet";
	protected $primaryKey = 'id_rekor';
	public $timestamps = true;
	const CREATED_AT = 'create_at';
	const UPDATED_AT = 'create_at';
}
