<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class FileManagerController extends BaseController
{
    function all(){
    	return view('file-manager.all');
    }
}
