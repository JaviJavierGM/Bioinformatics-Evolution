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
        $projects = Project::all();
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
        if(!empty($params && !empty($params_array))) {
            // Obtener usuario identificado
            $jwtAuth = new JwtAuth();
            $user = $jwtAuth->checkToken($token, true);

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
                    'message' => "The project wasn't saved!"
                );
            } else {
                $project = new Project();
                $project->title = $params->title;
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
                $project->user_id = $user->sub;
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
                'message' => "Data dosn't  exist!"
            );
        }

        return $data;
    }
}
