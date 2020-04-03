<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class PerfilController extends BaseController
{
    function miPerfil(){
    	return view('examples.pages.profile');
    }
}