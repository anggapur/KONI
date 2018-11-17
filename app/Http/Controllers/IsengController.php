<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GH;

class IsengController extends Controller
{
    public function index(){
    	$data = GH::getCountEvent();
    	$data += GH::getCountPrestasi();
    	$data += GH::getCountRekor();
    	$data += GH::getPrestasiTerbaru(8);
    	dd($data);
    	return view('home',['data' => $data]);
    }
}