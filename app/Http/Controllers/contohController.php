<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

<<<<<<< HEAD
class contohController extends Controller
{
    //
    public function index()
    {
     return view('filecontoh');
    }
=======
use App\Cabang_Olahraga;
class contohController extends Controller
{
    
    function index()
    {
    	$data['listCabangOlahraga'] = Cabang_Olahraga::all();
    	// return $query;
    	return view("noPertandingan",$data);
    	
>>>>>>> d7349678959e03ea543d628a31872dedafa95563
}
