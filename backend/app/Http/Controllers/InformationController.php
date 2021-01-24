<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function tests(Request $request) {
        return "Accion de pruebas de INFORMATION-CONTROLLER";
    }
}
