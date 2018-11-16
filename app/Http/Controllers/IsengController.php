<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GH;

class IsengController extends Controller
{
    public function index(){
    	$data = GH::getCountGender('atlet');
    	return view('welcome',['data' => $data]);
    }
}