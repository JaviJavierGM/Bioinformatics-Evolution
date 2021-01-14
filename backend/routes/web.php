<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function() {
    return '<h1>Hola mundo - Prueba 111</h1>';
});

Route::get('/pruebas/{name?}', function($name = null){
    $text = '<h2>Texto desde una ruta !!</h2>';
    $text .= 'Nombre: '.$name;

    return view('pruebas', array(
        'text' => $text
    ));
});

Route::get('/animals', [PruebasController::class, 'index']);