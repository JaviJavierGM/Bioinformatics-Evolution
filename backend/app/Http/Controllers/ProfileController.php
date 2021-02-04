<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Personal\ProfileManager;
use App\Models\Personal\User;

class ProfileController extends Controller
{
    public function tests(Request $request) {
        return "Accion de pruebas de PROFILE-CONTROLLER";
    }

    public function register(Request $request) {
        // Recoger los datos del usuario por post
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        // Enviar y procesar los datos en el modelo
        $profileManager = new ProfileManager($params, $params_array);
        $data = $profileManager->register();

        return response()->json($data, $data['code']);
    }

    public function login(Request $request) {
        // Recibir los datos por POST
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        // Enviar y procesar los datos en el modelo
        $profileManager = new ProfileManager($params, $params_array);
        $data = $profileManager->login();

        return response()->json($data, 200);
    }

    public function update(Request $request) {
        // Comprobar si el ususario esta identificado
        $token = $request->header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);

        // Recoger los datos por POST
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        // Enviar y procesar los datos en el modelo
        $profileManager = new ProfileManager(null, $params_array);
        $data = $profileManager->updateUser($token, $checkToken);
        
        return response()->json($data, $data['code']);
    }

    public function upload(Request $request){
        // Pasar todos los datos que vienen en la request a params_array
        $params_array = $request->all();

        // Recoger datos de la particion
        $image = $request->file('file0');

        // Eviar y procesar datos de la imagen en el modelo
        $profileManager = new ProfileManager(null, $params_array);
        $data = $profileManager->upload($image);
        
        return response()->json($data, $data['code']);
    }

    public function getImage($filename){

        // Eviar y procesar datos en el modelo
        $profileManager = new ProfileManager(null, null);
        $image = $profileManager->getImage($filename);

        return $image;        
    }

    public function detail($id){
        
        // Eviar y procesar datos en el modelo
        $profileManager = new ProfileManager(null, null);
        $data = $profileManager->detail($id);

        return response()->json($data, $data['code']);
    }

}
