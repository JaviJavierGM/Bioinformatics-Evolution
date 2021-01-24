<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function tests(Request $request) {
        return "Accion de pruebas de PROJECT-CONTROLLER";
    }
}
