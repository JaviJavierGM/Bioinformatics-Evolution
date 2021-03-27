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
        $correlatedSelected,
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
        $this->correlatedSelected = $correlatedSelected;
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
        die();

        return $execute;
    }

    public function executeVersion1() {
        echo 'Esta es la version 1 xD la mmlona xD <br>';

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

        echo "<br> PRIMERA GENERACION <br>";
                    $cont=0;
                    foreach($generation->getConformations() as $conformation){
                        echo "Conformation ".$cont."<br>";
                        $contPoint=0;
                        foreach($conformation->getPoints() as $point){
                            echo "Punto ".$contPoint."<br>";
                            echo "X: ".$point->getValueX()." , Y: ".$point->getValueY()." , Z: ".$point->getValueZ()."<br>";
                            // echo "movVect: ".$point->getMovVectorValue()."<br>";
                            $contPoint++;
                        }
                        
                        $cont++;
                    }

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
    
            // Cruce
            switch ($this->crossoverType) {
                case 'one_point':
                    $crossoverOnePoint = new OnePoint(
                        $generation, 
                        $this->spaceType, 
                        $this->dimensionType, 
                        strlen($this->hpSecuence), 
                        $this->conformationsNumber, 
                        $this->crossoverProbability, 
                        null, 
                        $this->hpSecuence, 
                        $this->mutationType,
                        $this->functionType,
                        $this->alphaValue
                    );
                    // var_dump($crossoverOnePoint->getNewGeneration()); die();
                    array_push($this->currentExperiment, $crossoverOnePoint->getNewGeneration());
                    var_dump($crossoverOnePoint->getNewGeneration()); die();
                    echo "<br> NUEVA GENERACION <br>";
                    $cont=0;
                    foreach($crossoverOnePoint->getNewGeneration()->getConformations() as $conformation){
                        echo "Conformation ".$cont."<br>";
                        $contPoint=0;
                        foreach($conformation->getPoints() as $point){
                            echo "Punto ".$contPoint."<br>";
                            echo "X: ".$point->getValueX()." , Y: ".$point->getValueY()." , Z: ".$point->getValueZ()."<br>";
                            // echo "movVect: ".$point->getMovVectorValue()."<br>";
                            $contPoint++;
                        }
                        
                        $cont++;
                    }
                    die();

                break;

                case 'two_points':
                    $crossoverTwoPoints = new TwoPoints(
                        $generation, 
                        $this->spaceType, 
                        $this->dimensionType, 
                        strlen($this->hpSecuence), 
                        $this->conformationsNumber, 
                        $this->crossoverProbability, 
                        null, 
                        $this->hpSecuence, 
                        $this->mutationType
                    );
                    // var_dump($crossoverTwoPoints->getNewGeneration()); die();
                    array_push($this->currentExperiment, $crossoverTwoPoints->getNewGeneration());
                break;

                case 'uniform':
                    $crossoverUniform = new Uniform(
                        $generation, 
                        $this->spaceType, 
                        $this->dimensionType, 
                        strlen($this->hpSecuence), 
                        $this->conformationsNumber, 
                        $this->crossoverProbability, 
                        null, 
                        $this->hpSecuence, 
                        $this->mutationType
                    );
                    // var_dump($crossoverUniform->getNewGeneration()->getConformations()); die();                    
                    array_push($this->currentExperiment, $crossoverUniform->getNewGeneration());
                    
                break;
                
                default:
                    echo 'Default case';
                break;
            }

        }

        /*
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
        */
    }

    public function executeVersion2() {
        echo 'Esta es la version 2 xD la mmlona xD';
    }
}
