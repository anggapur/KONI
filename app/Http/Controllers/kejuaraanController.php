<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kejuaraanController extends Controller
{
    public function index()
    {
    	$data['page'] = "Event";        
        $data['active'] = "Event";
    	return view('Kejuaraan.kejuaraan',$data);
    }
}
