<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class AuthenticationController extends BaseController
{
    function login(){
    	return view('authentication.login');
    }

    function register(){
    	return view('authentication.register');
    }

    function lockscreen(){
        return view('authentication.lockscreen');
    }

    function forgot(){
    	return view('authentication.forgot');
    }
    
    function page404(){
    	return view('authentication.page404');
    }

    function page500(){
        return view('authentication.page500');
    }

    function offline(){
    	return view('authentication.offline');
    }
}
