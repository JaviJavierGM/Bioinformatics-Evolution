<?php

namespace App\Models\Personal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Personal\User;

class ProfileManager extends Model
{
    use HasFactory;
    
    private $params;
    private $params_array;

    public function __construct($params, $params_array) {
        $this->params = $params;
        $this->params_array = $params_array;
    }

    public function register() {
        if(!empty($this->params) && !empty($this->params_array)) {
            // Limpiar datos
            $this->params_array = array_map('trim', $this->params_array);

            // Validar datos
            $validate = \Validator::make($this->params_array, [
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
                $pwd = hash('sha256', $this->params->password);

                // Crear el usuario
                $user = new User();
                $user->name = $this->params_array['name'];
                $user->surname = $this->params_array['surname'];
                $user->email = $this->params_array['email'];
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
        return $data;
    }

    public function login() {
        $jwtAuth = new \JwtAuth();

        // Validar datos
        $validate = \Validator::make($this->params_array, [
            'email'     =>  'required|email',
            'password'  =>  'required'
        ]);

        if($validate->fails()) {
            $signup = array(
                'status'    =>  'error',
                'code'      =>  404,
                'message'   =>  "The user couldn't be identified",
                'errors'    =>  $validate->errors()
            );
        } else {
            // Cifrar contraseña
            $pwd = hash('sha256', $this->params->password);

            // Devolver token ó datos
            $signup = $jwtAuth->signup($this->params->email, $pwd);

            if(!empty($this->params->getToken)) {
                $signup = $jwtAuth->signup($this->params->email, $pwd, true);
            }
        }
        return $signup;
    }

    public function updateUser($token, $checkToken) {
        $jwtAuth = new \JwtAuth();

        if($checkToken && !empty($this->params_array)) {
            // Obtener el usuario identificado
            $user = $jwtAuth->checkToken($token, true);

            // Validar los datos, en especial que no se repita el email, excepto en el usuario con el id marcado
            $validate = \Validator::make($this->params_array, [
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
            } else {
                // Quitar los campos que no quiero actualizar
                unset($this->params_array['id']);
                unset($this->params_array['role']);
                unset($this->params_array['password']);
                unset($this->params_array['created_at']);
                unset($this->params_array['remember_token']);
                
                // Actualizar el usuario
                $user_update = User::where('id', $user->sub)->update($this->params_array);

                // Devolver array con el resultado
                $data = array(
                    'code' => 200,
                    'status' => 'success',
                    'user' => $user,
                    'changes' => $this->params_array
                );
            }             
        } else {
            $data = array(
                'code' => 400,
                'status' => 'error',
                'message' => "The user isn't correctly identified"
            );
        }
        return $data;
    }

    public function upload($image){
        
        // Validacion de la imagen, pasando al validador todos los datos que vienen en la request
        $validate = \Validator::make($this->params_array, [
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

        return $data;
    }

    public function getImage($filename){

        $isset = \Storage::disk('users')->exists($filename);

        if($isset){
            $file = \Storage::disk('users')->get($filename);
            // return new Response($file, 200); -- NO BORRAR, HASTA DESPUES DE LAS PRUEBAS
            return response($file, 200);

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

        return $data;
    }

}
