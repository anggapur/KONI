<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GH;

class IsengController extends Controller
{
    public function index(){
    	    	
    	
    	$data = GH::getPrestasiByNPOnEvent(3);
    	dd($data);
    	return view('home',['data' => $data]);
    }
}