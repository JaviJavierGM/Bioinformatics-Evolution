<?php

namespace App\Models\EvolutionaryAlgorithm\EvolutionaryAlgorithmTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\Roulette;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\Tournament;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\TopPercent;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\PopulationDecimation;
use App\Models\EvolutionaryAlgorithm\CrossoverTypes\OnePoint;
use App\Models\EvolutionaryAlgorithm\CrossoverTypes\TwoPoints;
use App\Models\EvolutionaryAlgorithm\CrossoverTypes\Uniform;
use App\Models\EvolutionaryAlgorithm\CoupleFormationTypes\SimplexCoupleFormation;
use App\Models\EvolutionaryAlgorithm\GeneratePointsTypes\GenerateCubePoints;
use App\Models\EvolutionaryAlgorithm\GeneratePointsTypes\GenerateSquarePoints;
use App\Models\EvolutionaryAlgorithm\GeneratePointsTypes\GenerateTrianglePoints;

class Simple extends Model
{
    use HasFactory;
    private $isKnowBestFitness;
    private $generationsNumber;
    private $experimentsNumber;
    private $sampling;
    private $selectionOperator;
    private $currentExperiment;
    private $percent;
    private $experiments;

    public function __construct(
        $isKnowBestFitness,
        $generationsNumber,
        $experimentsNumber,
        $sampling,
        $selectionOperator,
        $currentExperiment,
        $percent
    ) {
        $this->isKnowBestFitness = $isKnowBestFitness;
        $this->generationsNumber = $generationsNumber;
        $this->experimentsNumber = $experimentsNumber;
        $this->sampling = $sampling;
        $this->selectionOperator = $selectionOperator;
        $this->currentExperiment = $currentExperiment;
        $this->percent = $percent;

        // Caso de saber el mejor fitness del projecto
        if($this->isKnowBestFitness) {
            $execute = $this->executeVersion2();
        } else {
            $execute = $this->executeVersion1();
        }
        die();

        return $execute;
    }

    public function executeVersion1(
        $crossoverType, 
        $spaceType, 
        $dimensionType, 
        $lengthHpString, 
        $conformationsNumber, 
        $crossoverProbability, 
        $correlatedMatrix, 
        $hpSecuence, 
        $mutationType
        ) {
        echo 'Esta es la version 1 xD la mmlona xD';
        $this->currentExperiment = array();
        $this->experiments = array();

        // Generar  la generacion inicial
        if($dimensionType == '2D_Square') {
            //$generation = new GenerateSquarePoints()
            
        } elseif($dimensionType == '2D_Triangle') {

        } elseif($dimensionType == '3D_Cubic') {

        }

        $j = 1;
        for($i=0; $i < $this->generationsNumber; $i++) {
            if ($this->selectionOperator == 'roulette') {
                $roulette = new Roulette($generation);
                if(!($roulette->execute())){
                    return false;
                }
            } elseif($this->selectionOperator == 'tournament') {
                $tournament = new Tournament($generation, $this->percent);
                if(!($tournament->execute())) {
                    return false;
                }
            } elseif($this->selectionOperator == 'top_percent') {
                $topPercent = new TopPercent($generation, $this->percent);
                if(!($topPercent->execute())) {
                    return false;
                }
            } elseif($this->selectionOperator == 'population_decimation') {
                $populationDec = new PopulationDecimation($generation);
                if(!($populationDec->execute())) {
                    return false;
                }
            }

            $coupleFormation = new SimplexCoupleFormation($generation);
            $coupleFormation->coupleFormation();

            if($crossoverType == 'one_point') {
                array_push($this->currentExperiment, new OnePoint(
                    $generation, 
                    $spaceType, 
                    $dimensionType, 
                    $lengthHpString, 
                    $conformationsNumber, 
                    $crossoverProbability, 
                    $correlatedMatrix, 
                    $hpSecuence, 
                    $mutationType
                ));
            } elseif($crossoverType == 'two_points') {
                array_push($this->currentExperiment, new TwoPoints(
                    $generation, 
                    $spaceType, 
                    $dimensionType, 
                    $lengthHpString, 
                    $conformationsNumber, 
                    $crossoverProbability, 
                    $correlatedMatrix, 
                    $hpSecuence, 
                    $mutationType
                ));
            } elseif($crossoverType == 'uniform') {
                array_push($this->currentExperiment, new Uniform(
                    $generation, 
                    $spaceType, 
                    $dimensionType, 
                    $lengthHpString, 
                    $conformationsNumber, 
                    $crossoverProbability, 
                    $correlatedMatrix, 
                    $hpSecuence, 
                    $mutationType
                ));
            }

            if(($i % $this->sampling) == 0) {
                for ($k=$j; $k < $i; $k++) { 
                    echo 'Se debe modificar el arreglo de experimentos !!!<br>';
                }
                $j = $i + 1;
            }
        }

        $experimentsSize = sizeof($this->experiments);
    }

    public function executeVersion2() {
        echo 'Esta es la version 2 xD la mmlona xD';
    }
}
