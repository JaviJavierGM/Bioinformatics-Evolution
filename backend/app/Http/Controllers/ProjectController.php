<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Data\ProjectsManager;

class ProjectController extends Controller
{
    public function __construct() {
        $this->middleware('api.auth', ['except' => [
            'index', 
            'show', 
            'getImage'
        ]]);
    }

    public function index() {
        $projectsManager = new ProjectsManager();
        $projects = $projectsManager->index();

        return response()->json(array(
            'code' => 200,
            'status' => 'success',
            'projects' => $projects
        )   , 200);
    }

    public function show($id) {
        $projectsManager = new ProjectsManager();
        $data = $projectsManager->show($id);

        return response()->json($data, $data['code']);
    }

    public function store(Request $request) {
        // Recoger el token de la cabecera HTTP
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

    public function update($id, Request $request) {
        // Recoger el token de la cabecera HTTP
        $token = $request->header('Authorization', null);

        // Recoger los datos por post
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        // Enviar los datos al Modelo
        $projectsManager = new ProjectsManager();
        $data = $projectsManager->updateProject($id, $params_array, $token);

        // Devolver respuesta en Json
        return response()->json($data, $data['code']);
    }

    public function destroy($id, Request $request) {
        // Recoger el token de la cabecera HTTP
        $token = $request->header('Authorization', null);
        
        $projectsManager = new ProjectsManager();
        $data = $projectsManager->destroyProject($id, $token);

        // Devolver respuesta en Json
        return response()->json($data, $data['code']);
    }

    public function upload(Request $request) {
        // Recoger los datos
        $image = $request->file('file0');
        $params_array = $request->all();

        // Enviar los datos al modelo
        $projectsManager = new ProjectsManager();
        $data = $projectsManager->uploadImage($params_array, $image);

        // Devolver respuesta Json
        return response()->json($data, $data['code']);
    }

    public function getImage($filename) {
        // Enviar los datos al modelo
        $projectsManager = new ProjectsManager();
        $image = $projectsManager->getImage($filename);

        // Devolver respuesta en Json
        return $image;
    }

    public function getProjectsByUser($id) {
       $projectsManager = new ProjectsManager();
       $data = $projectsManager->getProjectsByUser($id);

       return response()->json($data, $data['code']);
    }
}
