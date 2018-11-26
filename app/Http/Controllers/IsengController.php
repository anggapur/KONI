<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GH;

class IsengController extends Controller
{
    public function index(){
    	    	
    	$data = [];    	
    	$data['page'] = 'Kontingen';
    	//$data = GH::getPrestasiByNPOnEvent(3);
    	//dd($data);
    	//return view('home',['data' => $data]);
    	return view('fileContoh',['data' => $data]);
    }
}