<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helpers;

use App\Models\EvolutionaryAlgorithm\EvolutionaryAlgorithmManager;


class EvolutionaryAlgorithmController extends Controller
{

    public function execute(Request $request) {
        
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        $evolutionaryAlgorithmManager = new EvolutionaryAlgortihmManager($params_array);
        $data = $evolutionaryAlgorithmManager->executeEvolutionaryAlgorithm();

        return response()->json($data, $data['code']);

    }

}
