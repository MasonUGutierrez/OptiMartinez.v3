<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class DashboardController extends BaseController
{
    function index(){
    	return view('examples.pages.blank');
    }
}
