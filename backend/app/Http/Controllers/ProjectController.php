<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Data\ProjectsManager;

class ProjectController extends Controller
{
    public function __construct() {
        $this->middleware('api.auth', ['except' => ['index','show']]);
    }

    public function tests(Request $request) {
        return "Accion de pruebas de PROJECT-CONTROLLER";
    }

    public function index() {
        $projectsManager = new ProjectsManager();
        $projects = $projectsManager->index();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'projects' => $projects
        ]);
    }

    public function show($id) {
        $projectsManager = new ProjectsManager();
        $data = $projectsManager->show($id);

        return response()->json($data, $data['code']);
    }

    public function store(Request $request) {
        // Recoger token
        $token = $request->header('Authorization', null);

        // Recoger los datos por post
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        // Enviar los datos al Modelo
        $projectsManager = new ProjectsManager();
        $data = $projectsManager->store($params, $params_array, $token);

        // Regresar respuesta Json.
        return response()->json($data, $data['code']);
    }
}
