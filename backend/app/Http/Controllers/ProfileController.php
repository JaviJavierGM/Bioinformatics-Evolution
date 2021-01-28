<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

        // Comprobar si el ususario esta identificado
        $token = $request->header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);

        // Recoger los datos por POST
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        if($checkToken && !empty($params_array)) {

            // Sacar usuario identificado
            $user = $jwtAuth->checkToken($token, true);

            // Validar los datos, en especial que no se repita el email,
            // excepto en el usuario con el id marcado
            $validate = \Validator::make($params_array, [
                'name'      =>  'required|alpha',
                'surname'   =>  'required|alpha',
                'email'     =>  'required|email|unique:users,email,'.$user->sub
            ]);

            if($validate->fails()){
                $data = array(
                    'code' => 400,
                    'status' => 'error',
                    'message' => "The email you are trying to use is already registered!"
                );

            }else{
                // Quitar los campos que no quiero actualizar
                unset($params_array['id']);
                unset($params_array['role']);
                unset($params_array['password']);
                unset($params_array['created_at']);
                unset($params_array['remember_token']);
                
                // Actualizar el usuario
                $user_update = User::where('id', $user->sub)->update($params_array);

                // Devolver array con el resultado
                $data = array(
                    'code' => 200,
                    'status' => 'success',
                    'user' => $user,
                    'changes' => $params_array
                );

            } 
            
        } else {
            $data = array(
                'code' => 400,
                'status' => 'error',
                'message' => "The user isn't correctly identified"
            );

        }
        
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

}
