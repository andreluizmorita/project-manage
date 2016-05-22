<?php

namespace CodeProject\OAuth;

use CodeProject\Entities\User;
use Illuminate\Support\Facades\Auth;

class PasswordGrantVerifier
{
	public function verify($username, $password)
	{	
		//dd($username);
		// $credentials = [
		// 	'email'    => $username,
		// 	'password' => $password,
		// ];

		// if (Auth::once($credentials)) {
		// 		return Auth::user()->id;
		// }

		// return false;

        if(Auth::validate(['email'=>$username,'password'=>$password])) {
            $user = \CodeProject\Entities\User::where('email', $username)->first();

            return $user->id;
      	}
      	
      	return FALSE;
      
	}
}