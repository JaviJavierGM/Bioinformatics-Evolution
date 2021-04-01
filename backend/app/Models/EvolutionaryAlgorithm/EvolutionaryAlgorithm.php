<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class EvolutionaryAlgorithm extends Model
{
    use HasFactory;

    protected $hpSecuence;

    protected $spaceType;
    protected $dimensionType;
    // protected $correlatedSelected;
    protected $fileNameCorrelatedNetwork;
    protected $pointsCorrelatedNetworkSelected;

    protected $selectionOperator;
    protected $percentOfTournament;
    protected $percentOfTopPercent;
    protected $crossoverType;
    protected $crossoverProbability;
    protected $mutationType;

    // protected $mutationProbability; --- AE Simple
    // protected $minimunMutationProbability;  --- AE rankGA
    // protected $maximunMutationProbability; --- AE rankGA
    // protected $clampMutationSelected; --- AE rankGA
    // protected $CaterpillarMutationSelected; --- AE rankGA
    // protected $proximityPairing; --- AE rankGA

    protected $isKnowBestFitness;
    protected $fitnessValue;
    protected $conformationsNumber;
    protected $generationsNumber;
    protected $experimentsNumber;
    protected $sampling;
        
    protected $elitismSelected;
    protected $percentOfElitism;

    protected $functionType;
    protected $alphaValue;

    protected $currentExperiment = array();
    protected $experiments = array();

    protected $execute;

    public function getExecute() {
        return $this->execute;
    }

    public function getExperiments() {
        return $this->experiments;
    }

    public function getExperimentsJson() {
        $experimentsJson = array();
        foreach($this->experiments as $experiment){
            
            $arrayTemp = array();

            foreach($experiment as $generation){
                array_push($arrayTemp, $generation->convertToJson());
            }

            array_push($experimentsJson, $arrayTemp);

        }

        return $experimentsJson;
    }

    abstract public function executeVersion1();

    abstract public function executeVersion2();

}
