<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministrativeController extends Controller
{
    public function tests(Request $request) {
        return "Accion de pruebas de ADMINISTRATIVE-CONTROLLER";
    }
}
