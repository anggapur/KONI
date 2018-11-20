<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        $data = [];
        $data['page'] = 'Dashboard';
        return view('home',['data' => $data]);
=======
        return view('home');
>>>>>>> 41ef5a1c08f83eaee56f68c1ff49dca8d84b8980
    }
}
