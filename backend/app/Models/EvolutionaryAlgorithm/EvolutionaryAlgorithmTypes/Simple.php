<?php

namespace App\Models\EvolutionaryAlgorithm\EvolutionaryAlgorithmTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\EvolutionaryAlgorithm;
use App\Models\EvolutionaryAlgorithm\GeneratePointsTypes\GenerateSquarePoints;
use App\Models\EvolutionaryAlgorithm\GeneratePointsTypes\GenerateTrianglePoints;
use App\Models\EvolutionaryAlgorithm\GeneratePointsTypes\GenerateCubePoints;
use App\Models\EvolutionaryAlgorithm\OtherGeneticTechniques\Elitism;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\Roulette;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\Tournament;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\TopPercent;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\PopulationDecimation;
use App\Models\EvolutionaryAlgorithm\CoupleFormationTypes\SimplexCoupleFormation;


use App\Models\EvolutionaryAlgorithm\CrossoverTypes\OnePoint;
use App\Models\EvolutionaryAlgorithm\CrossoverTypes\TwoPoints;
use App\Models\EvolutionaryAlgorithm\CrossoverTypes\Uniform;





class Simple extends EvolutionaryAlgorithm
{
    use HasFactory;
    
    private $mutationProbability;

    public function __construct(
        $hpSecuence,
        $spaceType,
        $dimensionType,
        // $correlatedSelected,
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
    ) {
        $this->hpSecuence = $hpSecuence;
        $this->spaceType = $spaceType;
        $this->dimensionType = $dimensionType;
        // $this->correlatedSelected = $correlatedSelected;
        $this->fileNameCorrelatedNetwork = $fileNameCorrelatedNetwork;
        $this->pointsCorrelatedNetworkSelected = $pointsCorrelatedNetworkSelected;
        $this->selectionOperator = $selectionOperator;
        $this->percentOfTournament = $percentOfTournament;
        $this->percentOfTopPercent = $percentOfTopPercent;
        $this->crossoverType = $crossoverType;
        $this->crossoverProbability = $crossoverProbability;
        $this->mutationType = $mutationType;
        $this->mutationProbability = $mutationProbability;
        $this->isKnowBestFitness = $isKnowBestFitness;
        $this->fitnessValue = $fitnessValue;
        $this->conformationsNumber = $conformationsNumber;
        $this->generationsNumber = $generationsNumber;
        $this->experimentsNumber = $experimentsNumber;
        $this->sampling = $sampling;
        $this->elitismSelected = $elitismSelected;
        $this->percentOfElitism = $percentOfElitism;
        $this->functionType = $functionType;
        $this->alphaValue = $alphaValue;

        // Caso de saber el mejor fitness del projecto
        if($this->isKnowBestFitness) {
            $execute = $this->executeVersion2();
        } else {
            $execute = $this->executeVersion1();
        }        

        return $execute;
    }

    public function executeVersion1() {
        // echo 'Esta es la version 1! <br>';

        for($numExp=0; $numExp < $this->experimentsNumber; $numExp++) {

            $j = 1;

            // Generar  la generacion inicial
            switch ($this->dimensionType) {
                case '2D_Square':
                    if($this->spaceType == "correlated") {
                        // Se generan los puntos 2D cuadrado en un medio correlacionado
                        // ------- PENDIENTE ------- 
                    }else{
                        // Se generan los puntos 2D cuadrado en un medio homogeno
                        $generatePoints = new GenerateSquarePoints($this->hpSecuence, $this->spaceType, null, $this->dimensionType, $this->functionType, $this->alphaValue);
                        $generation = $generatePoints->initializeGeneration($this->conformationsNumber);                    
                    }
                break;

                case '2D_Triangle':
                    // Se generan los puntos 2D triangular en un medio homogeno
                    $generatePoints = new GenerateTrianglePoints($this->hpSecuence, $this->spaceType, null, $this->dimensionType, $this->functionType, $this->alphaValue);
                    $generation = $generatePoints->initializeGeneration($this->conformationsNumber);                
                break;

                case '3D_Cubic':
                    // Se generan los puntos 3D cubico en un medio homogeno
                    $generatePoints = new GenerateCubePoints($this->hpSecuence, $this->spaceType, null, $this->dimensionType, $this->functionType, $this->alphaValue);
                    $generation = $generatePoints->initializeGeneration($this->conformationsNumber);
                break;
                
                default:
                    echo 'Default case';
                break;
            }

            // Agregamos la primera generacion            
            array_push($this->currentExperiment, $generation);

            // if($numExp == 1)
            //     die();

            for($i=0; $i<$this->generationsNumber; $i++) {
                // Seleccion de padres
                if($this->elitismSelected) {
                    if($this->selectionOperator == 'tournament') {
                        $elitism = new Elitism($this->percentOfElitism, $generation, $this->selectionOperator, $this->percentOfTournament);
                        $elitism->execute();                    
                    } elseif($this->selectionOperator == 'top_percent') {
                        $elitism = new Elitism($this->percentOfElitism, $generation, $this->selectionOperator, $this->percentOfTournament);
                        $elitism->execute();
                    } else {
                        $elitism = new Elitism($this->percentOfElitism, $generation, $this->selectionOperator, null);
                        $elitism->execute();
                    }
                                    
                } else {
                    switch ($this->selectionOperator) {
                        case 'roulette':
                            $roulette = new Roulette($generation);
                            $roulette->execute();                        
                        break;

                        case 'tournament':
                            $tournament = new Tournament($generation, $this->percentOfTournament);
                            $tournament->execute();                        
                        break;

                        case 'top_percent':
                            $topPercent = new TopPercent($generation, $this->percentOfTournament);
                            $topPercent->execute();                        
                        break;

                        case 'population_decimation':
                            $populationDecimation = new PopulationDecimation($generation);
                            $populationDecimation->execute();                        
                        break;
                            
                        default:
                            echo 'Default case';
                        break;
                    }
                }

                // Formacion de parejas
                $coupleFormation = new SimplexCoupleFormation($generation);
                $coupleFormation->coupleFormation();
        
                // Cruce, mutacion
                switch ($this->crossoverType) {
                    case 'one_point':
                        $crossoverOnePoint = new OnePoint(
                            $generation, 
                            $this->spaceType, 
                            $this->dimensionType, 
                            strlen($this->hpSecuence), 
                            $this->crossoverProbability, 
                            null, 
                            $this->hpSecuence, 
                            $this->mutationType,
                            $this->functionType,
                            $this->alphaValue
                        );
                        array_push($this->currentExperiment, $crossoverOnePoint->getNewGeneration());
                        $generation = $crossoverOnePoint->getNewGeneration();
                    break;

                    case 'two_points':

                        $crossoverTwoPoints = new TwoPoints(
                            $generation, 
                            $this->spaceType, 
                            $this->dimensionType, 
                            strlen($this->hpSecuence), 
                            $this->crossoverProbability, 
                            null, 
                            $this->hpSecuence, 
                            $this->mutationType,
                            $this->functionType,
                            $this->alphaValue
                        );
                        array_push($this->currentExperiment, $crossoverTwoPoints->getNewGeneration());
                        $generation = $crossoverTwoPoints->getNewGeneration();
                    break;

                    case 'uniform':
                        $crossoverUniform = new Uniform(
                            $generation, 
                            $this->spaceType, 
                            $this->dimensionType, 
                            strlen($this->hpSecuence),
                            $this->crossoverProbability, 
                            null, 
                            $this->hpSecuence, 
                            $this->mutationType,
                            $this->functionType,
                            $this->alphaValue
                        );
                        array_push($this->currentExperiment, $crossoverUniform->getNewGeneration());
                        $generation = $crossoverUniform->getNewGeneration();
                    break;
                    
                    default:
                        echo 'Default case';
                    break;
                }

                if(($i % $this->sampling) == 0) {
                    for($k=$j; $k<$i; $k++) {
                        $this->currentExperiment[$k] = null;
                    }
                    $j = $i + 1;
                }

            }

            $b = sizeof($this->currentExperiment);
            // var_dump($j);
            for($k=$j; $k<$b-1; $k++) {
                $this->currentExperiment[$k] = null;
            }
            // var_dump($this->currentExperiment);
            
            array_push($this->experiments, $this->currentExperiment);
            // unset($this->currentExperiment);
            $this->currentExperiment = array();
            // var_dump($this->currentExperiment);

            // echo "Termino exp: ".$numExp."<br>";
            // die();


        }        
        
        // var_dump($this->experiments);

        

        // die();

        return true;
        
    }

    public function executeVersion2() {
        echo 'Esta es la version 2 xD la mmlona xD';
    }
}
