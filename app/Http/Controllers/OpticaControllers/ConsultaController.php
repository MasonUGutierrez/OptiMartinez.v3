<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    //
    public function index(){
        return view('optometrista.consulta.index');
    }
}
