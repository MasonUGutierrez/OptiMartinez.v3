<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecepcionistaController extends Controller
{
    //
    public function index(){
        return view('recepcionista.view_calendar');
    }

    public function listaPaciente(){
        return view('recepcionista.view_pacientes');
    }
}
