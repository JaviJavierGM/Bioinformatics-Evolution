<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebasController extends Controller
{
    public function index() {
        $title = 'Animales';
        $animals = ['Perro', 'Gato', 'Tigre'];

        return view('pruebas.index', array(
            'animals' => $animals,
            'title' => $title
        ));
    }
}
