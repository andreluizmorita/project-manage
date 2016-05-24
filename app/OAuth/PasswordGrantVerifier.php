<?php

namespace CodeProject\OAuth;

use CodeProject\Entities\User;
use Illuminate\Support\Facades\Auth;

class PasswordGrantVerifier
{
	public function verify($username, $password)
	{	
		if(Auth::validate(['email'=>$username,'password'=>$password])) {
            $user = \CodeProject\Entities\User::where('email', $username)->first();

            return $user->id;
      	}
      	
      	return FALSE;
      
	}
}