<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class LoginController extends Controller
{
    

	public function index()
	{
		if(Auth::user())
			return redirect()->route('user.index');
		return view('backend.login')->withTitle('Login');
	}


	public function login(Request $request)
	{
		$this->middleware('csrf');
		$name 	= $request->input('name');
		$password = $request->input('password');

		$validator = $this->validator($request);
		if(!$validator->fails()){
			 if (Auth::attempt(['name' => $name,'password' => $password], 
			 					$request->input('remember'))){
			 	return redirect()->route('user.index');
			 }else{
			 	$vaidator->errors()->add('password', 'The Username or Password is incorrect');
			 }
		}

		return redirect()->route('login')
						->withErrors($validator)
						->withInput();

	}


	public function logout()
	{
		if(Auth::user())
			Auth::logout();
		return redirect()->route('login');
	}


	public function validator(Request $request){
		$validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required',
        ]);
        return $validator;
	}

}
