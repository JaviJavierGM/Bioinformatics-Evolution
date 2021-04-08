<?php

namespace App\Models\EvolutionaryAlgorithm\EvolutionaryAlgorithmTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\EvolutionaryAlgorithm;
use App\Models\EvolutionaryAlgorithm\CorrelatedNetwork;
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
        
        // Leer y guardar la matriz de correlacion
        if($this->spaceType == "correlated") {            
            $correlatedNetwork = new CorrelatedNetwork($this->fileNameCorrelatedNetwork, $this->pointsCorrelatedNetworkSelected[0], $this->pointsCorrelatedNetworkSelected[1], $this->pointsCorrelatedNetworkSelected[2], $this->pointsCorrelatedNetworkSelected[3]);
            $correlatedNetwork->readMatrix();
            $this->correlatedMatrix = $correlatedNetwork->getCorrelatedMatrix();
            unset($correlatedNetwork);
        }

        // Caso de saber el mejor fitness del projecto
        if($this->isKnowBestFitness) {
            $this->execute = $this->executeVersion2();
        } else {
            $this->execute = $this->executeVersion1();
        }        

    }

    public function executeVersion1() {
        // echo 'Esta es la version 1! <br>';                        
        if(($this->generationsNumber % 4) != 0) {
            $cont = $this->generationsNumber % 4;
        } else {
            $cont = intdiv($this->generationsNumber , 4);
        }        

        for($numExp=0; $numExp < $this->experimentsNumber; $numExp++) {

            $j = 1;

            // Generar  la generacion inicial
            switch ($this->dimensionType) {
                case '2D_Square':
                    if($this->spaceType == "correlated") {
                        // Se generan los puntos 2D cuadrado en un medio correlacionado
                        
                        // Segenera el punto inicial
                        $correlatedNetwork = new CorrelatedNetwork(null, null, null, null, null);
                        $correlatedNetwork->setCorrelatedMatrix($this->correlatedMatrix);
                        $correlatedNetwork->generateStartingPoint();
                        $this->startingPoint = $correlatedNetwork->getStartingPoint();
                       
                        $generatePoints = new GenerateSquarePoints($this->hpSecuence, $this->spaceType, $correlatedNetwork->getCorrelatedMatrix(), $this->dimensionType, $this->functionType, $this->alphaValue, $this->startingPoint);
                        $generation = $generatePoints->initializeGeneration($this->conformationsNumber);
                        unset($generatePoints);
                        
                    }else{
                        // Se generan los puntos 2D cuadrado en un medio homogeno
                        $generatePoints = new GenerateSquarePoints($this->hpSecuence, $this->spaceType, null, $this->dimensionType, $this->functionType, $this->alphaValue);
                        $generation = $generatePoints->initializeGeneration($this->conformationsNumber);
                        unset($generatePoints);
                    }
                break;

                case '2D_Triangle':
                    // Se generan los puntos 2D triangular en un medio homogeno
                    $generatePoints = new GenerateTrianglePoints($this->hpSecuence, $this->spaceType, null, $this->dimensionType, $this->functionType, $this->alphaValue);
                    $generation = $generatePoints->initializeGeneration($this->conformationsNumber);
                    unset($generatePoints);
                break;

                case '3D_Cubic':
                    // Se generan los puntos 3D cubico en un medio homogeno
                    $generatePoints = new GenerateCubePoints($this->hpSecuence, $this->spaceType, null, $this->dimensionType, $this->functionType, $this->alphaValue);
                    $generation = $generatePoints->initializeGeneration($this->conformationsNumber);
                    unset($generatePoints);
                break;
                
                default:
                    echo 'Default case';
                break;
            }

            // Agregamos la primera generacion            
            array_push($this->currentExperiment, $generation);

            for($i=1; $i<=$this->generationsNumber; $i++) {
                // Seleccion de padres
                if($this->elitismSelected) {
                    if($this->selectionOperator == 'tournament') {
                        $elitism = new Elitism($this->percentOfElitism, $generation, $this->selectionOperator, $this->percentOfTournament);
                        if(!$elitism->execute()) {
                            return false;
                        }
                        unset($elitism);
                    } elseif($this->selectionOperator == 'top_percent') {
                        $elitism = new Elitism($this->percentOfElitism, $generation, $this->selectionOperator, $this->percentOfTournament);
                        if(!$elitism->execute()) {
                            return false;
                        }
                        unset($elitism);
                    } else {
                        $elitism = new Elitism($this->percentOfElitism, $generation, $this->selectionOperator, null);
                        if(!$elitism->execute()) {
                            return false;
                        }
                        unset($elitism);
                    }
                                    
                } else {
                    switch ($this->selectionOperator) {
                        case 'roulette':
                            $roulette = new Roulette($generation);
                            if(!$roulette->execute()) {
                               return false;
                            }
                            unset($roulette);
                        break;

                        case 'tournament':
                            $tournament = new Tournament($generation, $this->percentOfTournament);
                            if(!$tournament->execute()) {
                                return false;
                            }
                            unset($tournament);
                        break;

                        case 'top_percent':
                            $topPercent = new TopPercent($generation, $this->percentOfTournament);
                            if(!$topPercent->execute()) {
                                return false;
                            }
                            unset($topPercent);
                        break;

                        case 'population_decimation':
                            $populationDecimation = new PopulationDecimation($generation);
                            if(!$populationDecimation->execute()) {
                                return false;
                            }
                            unset($populationDecimation);
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
                        if($this->spaceType == "correlated") {
                            $crossoverOnePoint = new OnePoint(
                                $generation, 
                                $this->spaceType, 
                                $this->dimensionType, 
                                strlen($this->hpSecuence), 
                                $this->crossoverProbability, 
                                $this->correlatedMatrix, 
                                $this->hpSecuence, 
                                $this->mutationType,
                                $this->functionType,
                                $this->alphaValue,
                                $this->startingPoint->getValueX(),
                                $this->startingPoint->getValueY()
                            );
                        } else {
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
                        }
                        
                        array_push($this->currentExperiment, $crossoverOnePoint->getNewGeneration());
                        $generation = $crossoverOnePoint->getNewGeneration();
                        unset($crossoverOnePoint);
                    break;

                    case 'two_points':
                        if($this->spaceType == "correlated") {
                            $crossoverTwoPoints = new TwoPoints(
                                $generation, 
                                $this->spaceType, 
                                $this->dimensionType, 
                                strlen($this->hpSecuence), 
                                $this->crossoverProbability, 
                                $this->correlatedMatrix, 
                                $this->hpSecuence, 
                                $this->mutationType,
                                $this->functionType,
                                $this->alphaValue,
                                $this->startingPoint->getValueX(),
                                $this->startingPoint->getValueY()
                            );
                        } else {
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
                        }
                        array_push($this->currentExperiment, $crossoverTwoPoints->getNewGeneration());
                        $generation = $crossoverTwoPoints->getNewGeneration();
                        unset($crossoverTwoPoints);
                    break;

                    case 'uniform':
                        if($this->spaceType == "correlated") {
                            $crossoverUniform = new Uniform(
                                $generation, 
                                $this->spaceType, 
                                $this->dimensionType, 
                                strlen($this->hpSecuence), 
                                $this->crossoverProbability, 
                                $this->correlatedMatrix, 
                                $this->hpSecuence, 
                                $this->mutationType,
                                $this->functionType,
                                $this->alphaValue,
                                $this->startingPoint->getValueX(),
                                $this->startingPoint->getValueY()
                            );
                        } else {
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
                        }
                        array_push($this->currentExperiment, $crossoverUniform->getNewGeneration());
                        $generation = $crossoverUniform->getNewGeneration();
                        unset($crossoverUniform);
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
                
                if($i == $cont){
                    // Borrar las conformaciones que no se necesitan
                    $this->saveGenerationsJson();
                    $cont += intdiv($this->generationsNumber , 4);                    
                }

            }

            $b = sizeof($this->currentExperiment);
            // var_dump($j);
            for($k=$j; $k<$b-1; $k++) {
                $this->currentExperiment[$k] = null;
            }
            // var_dump($this->currentExperiment);
            
            // Guardar los experimentos en JSON
            // array_push($this->experiments, $this->currentExperiment);
            $this->saveExperimentsJson();


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
