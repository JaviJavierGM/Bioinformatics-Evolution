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
Route::get('/api/project/image/{filename}', [ProjectController::class, 'getImage']);
Route::get('/api/project/user/{id}', [ProjectController::class, 'getProjectsByUser']);

    //Rutas del controlador del algoritmo evolutivo
Route::post('/api/EA/uniform', [EvolutionaryAlgorithmController::class, 'testUniformCrossover']);
Route::post('/api/EA/onepoint', [EvolutionaryAlgorithmController::class, 'testOnePointCrossover']);
Route::post('/api/EA/twopoints', [EvolutionaryAlgorithmController::class, 'testTwoPointsCrossover']);
Route::post('/api/EA/ruleta', [EvolutionaryAlgorithmController::class, 'testRouletteSelection']);
Route::post('/api/EA/torneo', [EvolutionaryAlgorithmController::class, 'testTournamentSelection']);
Route::post('/api/EA/top-percent', [EvolutionaryAlgorithmController::class, 'testTopPercentSelection']);
Route::post('/api/EA/pop-decimation', [EvolutionaryAlgorithmController::class, 'testPopulationDecimation']);
Route::post('/api/EA/elitismo', [EvolutionaryAlgorithmController::class, 'testElitism']);
Route::post('/api/EA/GenarateSquarePoints', [EvolutionaryAlgorithmController::class, 'testGenerateSquarePoints']);
Route::post('/api/EA/GenarateTrianglePoints', [EvolutionaryAlgorithmController::class, 'testGenerateTrianglePoints']);
Route::post('/api/EA/GenarateCubePoints', [EvolutionaryAlgorithmController::class, 'testGenerateCubePoints']);
Route::post('/api/EA/readmatrix', [EvolutionaryAlgorithmController::class, 'testReadMatrix']);
Route::post('/api/EA/startingpoint', [EvolutionaryAlgorithmController::class, 'testStartingPoint']);
Route::post('/api/EA/gen-point', [EvolutionaryAlgorithmController::class, 'testGenPoint']);
Route::post('/api/EA/randomMut', [EvolutionaryAlgorithmController::class, 'testRandomMutation']);
Route::post('/api/EA/fitness', [EvolutionaryAlgorithmController::class, 'testFitness']);
Route::post('/api/EA/coupleformation-simplex', [EvolutionaryAlgorithmController::class, 'testCoupleFormationSimplex']);
Route::post('/api/EA/checksquare', [EvolutionaryAlgorithmController::class, 'testCheckSquare']);
Route::post('/api/EA/checktriangle', [EvolutionaryAlgorithmController::class, 'testCheckTriangle']);
Route::post('/api/EA/predefined', [EvolutionaryAlgorithmController::class, 'testOpMutationPredefined']);
Route::post('/api/EA/random', [EvolutionaryAlgorithmController::class, 'testOpMutationRandom']);
Route::post('/api/EA/simple', [EvolutionaryAlgorithmController::class, 'testEASimple']);
