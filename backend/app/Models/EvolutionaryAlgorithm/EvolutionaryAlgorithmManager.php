<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\EvolutionaryAlgorithm\Point;
use App\Models\EvolutionaryAlgorithm\EvolutionaryAlgorithmTypes\Simple;

class EvolutionaryAlgorithmManager extends Model
{
    use HasFactory;
    private $params_array;

    public function __construct($params_array) {
        $this->params_array = $params_array;
    }
    
    public function executeEvolutionaryAlgorithm() {
        
        $data = array(
            'code' => 404,
            'status' => 'error',
            'message' => "Data dosen't sending"
        );

        if(!empty($this->params_array)) {
            
            // Se recogen los datos
            $optimizationAlgorithm = $this->params_array['optimization_algorithm'];
            $hpSecuence = $this->params_array['aminoacid'];
            $spaceType = $this->params_array['space_type'];
            $dimensionType = $this->params_array['dimension_type'];
            $fileNameCorrelatedNetwork = $this->params_array['fileNameCorrelatedNetwork'];
            if($spaceType == "correlated") {
                $pointUpperLeft = new Point($this->params_array['upperLeftPoint'][1] , $this->params_array['upperLeftPoint'][0], null, null, null);
                $pointUpperRight = new Point($this->params_array['upperRightPoint'][1] , $this->params_array['upperRightPoint'][0], null, null, null);
                $pointLowerLeft = new Point($this->params_array['lowerLeftPoint'][1] , $this->params_array['lowerLeftPoint'][0], null, null, null);
                $pointLowerRight = new Point($this->params_array['lowerRightPoint'][1] , $this->params_array['lowerRightPoint'][0], null, null, null);                
                $pointsCorrelatedNetworkSelected = array($pointUpperLeft, $pointUpperRight, $pointLowerLeft, $pointLowerRight);
            } else {
                $pointsCorrelatedNetworkSelected = null;
            }
            $selectionOperator = $this->params_array['selection_op'];
            $percentOfTournament = $this->params_array['percent_tournament'];
            $percentOfTopPercent = $this->params_array['percent_best'];
            $crossoverType = $this->params_array['crossover_op'];
            $crossoverProbability = $this->params_array['crossover_probability'];
            $mutationType = $this->params_array['mutation_op'];
            $mutationProbability = $this->params_array['mutation_probability'];
            $isKnowBestFitness = $this->params_array['i_know_fitness'];
            $fitnessValue = $this->params_array['final_fitness'];
            $conformationsNumber = $this->params_array['conformations'];
            $generationsNumber = $this->params_array['times_algorithm'];
            $experimentsNumber = $this->params_array['experiments'];
            $sampling = $this->params_array['sampling'];
            $elitismSelected = $this->params_array['elitism'];
            $percentOfElitism = $this->params_array['percent_elitism'];
            $functionType = $this->params_array['fitness_function'];
            $alphaValue = $this->params_array['alpha_value'];
            // RankGA
            $caterpillarMutationSelected = $this->params_array['caterpillar_mutation'];
            $clampMutationSelected = $this->params_array['clamp_mutation'];
            $maxMutationProbability = $this->params_array['max_mutation_probability'];
            $minMutationProbability = $this->params_array['min_mutation_probability'];
            $proximityPairing = $this->params_array['proximity_pairing'];

            if($optimizationAlgorithm == "simple") {
                $AESimple = new Simple(
                    $hpSecuence,
                    $spaceType,
                    $dimensionType,
                    $fileNameCorrelatedNetwork,
                    $pointsCorrelatedNetworkSelected,
                    $selectionOperator,
                    $percentOfTournament,
                    $percentOfTopPercent,
                    $crossoverType,
                    $crossoverProbability,
                    $mutationType,
                    $mutationProbability,
                    $isKnowBestFitness,
                    $fitnessValue,
                    $conformationsNumber,
                    $generationsNumber,
                    $experimentsNumber,
                    $sampling,
                    $elitismSelected,
                    $percentOfElitism,
                    $functionType,
                    $alphaValue
                );

                if($AESimple->getExecute()) {                    
                    $data = array(
                        'code' => 200,
                        'status' => 'success',
                        'space_type' => $spaceType,
                        'dimension_type' => $dimensionType,
                        'experiments' => $AESimple->getExperimentsJson2()
                    );
                } else{
                    $data = array(
                        'code' => 404,
                        'status' => 'error',
                        'message' => "Execution error!"
                    );
                }

            } else {
                // ------ AE RankGA
                // ...
                // ...
            }

        }

        return $data;
    }

}
