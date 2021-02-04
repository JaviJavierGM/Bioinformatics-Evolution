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

        // Recoger datos de la particion
        $image = $request->file('file0');

        // Validacion de la imagen
        $validate = \Validator::make($request->all(), [
            'file0' => 'required|image|mimes:jpg,jpeg,png,gif'
        ]);

        // Guardar imagen
        if(!$image || $validate->fails()){
            $data = array(
                'code' => 400,
                'status' => 'error',
                'message' => "The image hasn't been uploaded correctly"
            );

        }else{
            $image_name = time().$image->getClientOriginalName();
            \Storage::disk('users')->put($image_name, \File::get($image));

            $data = array(
                'code' => 200,
                'status' => 'success',
                'image' => $image_name
            );        
        }
        
        return response()->json($data, $data['code']);
    }

    public function getImage($filename){
        $isset = \Storage::disk('users')->exists($filename);

        if($isset){
            $file = \Storage::disk('users')->get($filename);
            return new Response($file, 200);

        }else{
            $data = array(
                'code' => 404,
                'status' => 'error',
                'massage' => "The image doesn't exist"
            ); 
            return response()->json($data, $data['code']);

        }        
        
    }

    public function detail($id){
        $user = User::find($id);

        if(is_object($user)){
            $data = array(
                'code' => 200,
                'status' => 'success',
                'user' => $user
            );
        }else{
            $data = array(
                'code' => 404,
                'status' => 'error',
                'massage' => "User doesn't exist"
            ); 
        }

        return response()->json($data, $data['code']);
    }

    public function pr(Request $request) {
        // Comprobar si el ususario esta identificado
        $token = $request->header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);

        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        $profileManager = new ProfileManager($params, $params_array);
        $data = $profileManager->updateUser($token, $checkToken);
        return response()->json($data, $data['code']);
    }

}
