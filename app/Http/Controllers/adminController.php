<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Hash;

class adminController extends Controller
{
    //

    public function index(){
        $data['page'] = "Manajemen Admin";
    	return view('admin.admin',$data);
    }

    public function tampil(){
        //User diambil dari providers, tampil=nama function)
        $post = User::all();

        $data['page'] = 'Data User';
        return view('admin.view',['tampil'=>$post,'data'=>$data]);

        return view('admin.view',['tampil'=>$post,'page'=>'Manajemen Admin']);

    }

    public function edit($id){
        $user = User::where('id',$id)->first(); //select

        $data['page'] = 'Edit User';
        return view('admin.edit',['user'=>$user,'data'=>$data]);

        return view('admin.edit',['user'=>$user,'page'=>'Manajemen Admin']);

    }

    public function update(Request $request, $id_user){
        $user = User::where('id',$id_user)->first();
        $user->name=$request->name;
        $user->email=$request->email;

        $status = '5';
        if($status == '5'){
            if(!$user->save()) {
                $status = 6;
            }
        }
        return Redirect()->route('view')->with('status',$status); 
    }

    public function getdata($id){
        $user = User::where('id',$id)->first();
        return view('admin.view',['user'=>$user]);
    }

    public function hapus($id_user){
        $user = User::where('id',$id_user)->first();
        if($user->delete()){
            return Redirect()->route('view')->with('success','1');
        }
    }

    public function admin(Request $request){

    	$request->all();
        $data = new User();
    	$data->name = $request->name;
		$data->email = $request->email;
        $cpassword = $request->cpassword;
        $password = $request->password;    
		/*
        $hash = $this->hashSSHA($request->password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt	
        */
		$data->password = Hash::make($request->password);
        $user = User::where('email','=',$data->email)->first();
		//$data->remember_token = $salt;

        $status = '0';
        if ($user != null) {
            $status = '1';
        }
        else{
            if (strlen($password)>=6) {
                if ($password != $cpassword) {
                    $status = '3';
                }
            }
            else{
                    $status = '2';
            }
        }

        if($status == '0'){
            if(!$data->save()) {
                $status = '4';
            }
        }

        $data['page'] = 'Tambah User';
        if($status == 0)
            return Redirect('admin/view')->with(['status' => $status,'data' => $data]);
        else
            return Redirect()->back()->with(['status' => $status,'data' => $data]);
	}

	public function hashSSHA($password) {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }
	public function checkhashSSHA($salt, $password) {

        $hash = base64_encode(sha1($password . $salt, true) . $salt);

        return $hash;
    }
    public function formTambah()
    {
        $data['page'] = "Tambah User";
        return view('admin.formTambah',['data'=> $data]);
    }
}
