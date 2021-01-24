<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GraphicController extends Controller
{
    public function tests(Request $request) {
        return "Accion de pruebas de GRAPHIC-CONTROLLER";
    }
}
