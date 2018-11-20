<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cabang_Olahraga;
class contohController extends Controller
{
    
    function index()
    {
    	$data['listCabangOlahraga'] = Cabang_Olahraga::all();
    	// return $query;
    	return view("noPertandingan",$data);
    	
    }
}
