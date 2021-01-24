<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

        if(!empty($params) && !empty($params_array)) {
            // Limpiar datos
            $params_array = array_map('trim', $params_array);

            // Validar datos
            $validate = \Validator::make($params_array, [
                'name'      =>  'required|alpha',
                'surname'   =>  'required|alpha',
                'email'     =>  'required|email|unique:users',
                'password'  =>  'required'
            ]);

            if($validate->fails()) {
                $data = array(
                    'status'    =>  'error',
                    'code'  =>  404,
                    'message'   =>  "The user hasn't been created",
                    'errors'    =>  $validate->errors()
                );
            } else {                
                // Cifrar la contraseña
                $pwd = hash('sha256', $params->password);

                // Crear el usuario
                $user = new User();
                $user->name = $params_array['name'];
                $user->surname = $params_array['surname'];
                $user->email = $params_array['email'];
                $user->password = $pwd;
                $user->role = 'ROLE_USER';

                // Guardar el usuario
                $user->save();

                $data = array(
                    'status'    =>  'success',
                    'code'      =>  200,
                    'message'   =>  'The user has been created successfully',
                    'user'      =>  $user
                );
            }
        } else {
            $data = array(
                'status'    =>  'error',
                'code'  =>  404,
                'message'   =>  "The data sending isn't correct"
            );
        }

        return response()->json($data, $data['code']);
    }

    public function login(Request $request) {
        $jwtAuth = new \JwtAuth();

        // Recibir los datos por POST
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        // Validar datos
        $validate = \Validator::make($params_array, [
            'email'     =>  'required|email',
            'password'  =>  'required'
        ]);

        if($validate->fails()) {
            $signup = array(
                'status'    =>  'error',
                'code'  =>  404,
                'message'   =>  "The user couldn't be identified",
                'errors'    =>  $validate->errors()
            );
        } else {
            // Cifrar contraseña
            $pwd = hash('sha256', $params->password);

            // Devolver token ó datos
            $signup = $jwtAuth->signup($params->email, $pwd);
            if(!empty($params->getToken)) {
                $signup = $jwtAuth->signup($params->email, $pwd, true);
            }

        }

        return response()->json($signup, 200);
    }

    public function update(Request $request) {
        $token = $request->header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);

        if($checkToken) {
            echo "<h1>Login Correcto</h1>";
        } else {
            echo "<h1>Login Incorrecto</h1>";
        }
        die();
    }
}
