<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministrativeController;
use App\Http\Controllers\CorrelatedNetworkController;
use App\Http\Controllers\EvolutionaryAlgorithmController;
use App\Http\Controllers\FoldingController;
use App\Http\Controllers\GraphicController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PruebasController;
use App\Http\Controllers\VisualizeController;


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

//RUTAS DE PRUEBAS

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

//RUTAS DEL API

    //Rutas del controlador de usuarios
Route::post('/api/register', [ProfileController::class, 'register']);
Route::post('/api/login', [ProfileController::class, 'login']);
Route::post('/api/user/update', [ProfileController::class, 'update']);
Route::post('/api/user/upload', [ProfileController::class, 'upload'])->middleware('api.auth');
Route::get('/api/user/image/{filename}', [ProfileController::class, 'getImage']);
Route::get('/api/user/datail/{id}', [ProfileController::class, 'detail']);
Route::get('/api/user/verify/{code}', [ProfileController::class, 'verifyCode']);

    //Rutas del controlador de projectos
Route::resources(['/api/project' => ProjectController::class]);
Route::post('/api/project/upload', [ProjectController::class, 'upload']);

    //Rutas del controlador del algoritmo evolutivo
Route::post('/api/EA', [EvolutionaryAlgorithmController::class, 'testOnePointCrossover']);

