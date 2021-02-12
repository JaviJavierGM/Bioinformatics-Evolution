<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Data\Project;
use App\Helpers\JwtAuth;

class ProjectsManager extends Model
{
    use HasFactory;

    public function index() {
        $projects = Project::all()->load('user');
        return $projects;
    }

    public function show($id) {
        $project = Project::find($id);

        if(is_object($project)) {
            $data = array(
                'code' => 200,
                'status' => 'success',
                'project' => $project
            );
        } else {
            $data = array(
                'code' => 404,
                'status' => 'error',
                'message' => "the project doesn't exist!"
            );
        }

        return $data;
    }

    public function store($params, $params_array, $token) {
        if(is_object($params) && !empty($params_array)) {
            // Obtener usuario identificado
            $user = $this->getIdentity($token);

            // Validar los datos
            $validate = \Validator::make($params_array, [
                'title' => 'required',
                'aminoacid' => 'required',
                'space_type' => 'required',
                'dimension_type' => 'required',
                'optimization_algorithm' => 'required',
                'selection_op' => 'required',
                'crossover_op' => 'required',
                'mutation_op' => 'required',
                'conformations' => 'required',
                'times_algorithm' => 'required',
                'experiments' => 'required',
                'crossover_probability' => 'required'
            ]);

            // Guardar el projecto
            if($validate->fails()) {
                $data = array(
                    'code'  =>  400,
                    'status' => 'error',
                    'message' => "The project wasn't saved, data is missing!",
                    'errors' => $validate->errors()
                );
            } else {
                $project = new Project();
                $project->title = $params->title;
                $project->user_id = $user->sub;
                $project->aminoacid = $params->aminoacid;
                $project->space_type = $params->space_type;
                $project->dimension_type = $params->dimension_type;
                $project->optimization_algorithm = $params->optimization_algorithm;
                $project->selection_op = $params->selection_op;
                $project->crossover_op = $params->crossover_op;
                $project->mutation_op = $params->mutation_op;
                $project->elitism = $params->elitism;
                $project->clamp_mutation = $params->clamp_mutation;
                $project->caterpillar_mutation =  $params->caterpillar_mutation;
                $project->conformations = $params->conformations;
                $project->times_algorithm = $params->times_algorithm;
                $project->experiments = $params->experiments;
                $project->sampling = $params->sampling;
                $project->percent_tournament = $params->percent_tournament;
                $project->percent_best = $params->percent_best;
                $project->crossover_probability = $params->crossover_probability;
                $project->min_mutation_probability = $params->min_mutation_probability;
                $project->max_mutation_probability = $params->max_mutation_probability;
                $project->proximity_pairing = $params->proximity_pairing;
                $project->final_fitness = $params->final_fitness;
                $project->image = $params->image;
                $project->save();

                $data = array(
                    'code'  =>  200,
                    'status' => 'success',
                    'project' => $project
                );
            }
        } else {
            $data = array(
                'code'  =>  400,
                'status' => 'error',
                'message' => "Send the data correctly!"
            );
        }

        return $data;
    }

    public function updateProject($id, $params_array, $token) {
        // Respuesta default de error en un arreglo asociativo
        $data = array(
            'code' => 400,
            'status' => 'error',
            'message' => "Send the data correctly!"
        ); 

        if(!empty($params_array))  {
            // Obtener el usuario identificado
            $user = $this->getIdentity($token);

            // Validar los datos
            $validate = \Validator::make($params_array,[
                'title' => 'required',
                'aminoacid' => 'required',
                'space_type' => 'required',
                'dimension_type' => 'required',
                'optimization_algorithm' => 'required',
                'selection_op' => 'required',
                'crossover_op' => 'required',
                'mutation_op' => 'required',
                'conformations' => 'required',
                'times_algorithm' => 'required',
                'experiments' => 'required',
                'crossover_probability' => 'required'
            ]);

            if($validate->fails()) {
                $data['message'] = "The project wasn't updated, data is missing!";
                $data['errors'] = $validate->errors();
            } else {
                // Eliminar lo que no queremos actualizar
                unset($params_array['id']);
                unset($params_array['created_at']);
                unset($params_array['user']);
                $params_array['user_id'] = $user->sub;

                // Buscar el registro a actualizar
                $project = Project::where('id', $id)
                            ->where('user_id', $user->sub)
                            ->first();

                // Verificación de que existe el registro en la DB
                if(!empty($project) && is_object($project)) {
                    // Actualizar el registro en concreto 
                    $project->update($params_array);

                    $data = array(
                        'code' => 200,
                        'status' => 'success',
                        'project' => $project,
                        'changes' => $params_array
                    );                    
                } else {
                    $data['message'] = "The project doesn't exist";
                }        
            }
        }

        return $data;
    }

    public function destroyProject($id, $token) {
        // Obtener el usuario identificado
        $user = $this->getIdentity($token);

        // Conseguir el registro asociado al id
        $project = Project::where('id', $id)
                            ->where('user_id', $user->sub)
                            ->first();

        if(!empty($project)) {
            // Borrar el registro
            $project->delete();

            $data = array(
                'code' => 200,
                'status' => 'success',
                'project' => $project
            );
        } else {
            $data = array(
                'code' => 404,
                'status' => 'error',
                'message' => "The project doesn't exist"
            );
        }

        return $data;
    }

    public function uploadImage($params_array, $image) {
        // Validar imagen
        $validate = \Validator::make($params_array, [
            'file0' => 'required|image|mimes:jpg,jpeg,png,gif'
        ]);

        // Guardar la imagen
        if(!$image || $validate->fails()) {
            $data = array(
                'code' => 400,
                'status' => 'error',
                'message' => 'Image upload error'
            );
        } else {
            $image_name = time().$image->getClientOriginalName();

            \Storage::disk('projects')->put($image_name, \File::get($image));

            $data = array(
                'code' => 200,
                'status' => 'success',
                'image' => $image_name
            );
        }

        return $data;
    }

    private function getIdentity($token) {
        $jwtAuth = new JwtAuth();
        $user = $jwtAuth->checkToken($token, true);
        return $user;
    }
}
