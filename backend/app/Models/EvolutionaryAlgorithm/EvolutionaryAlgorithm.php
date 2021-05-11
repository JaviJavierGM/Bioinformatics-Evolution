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
    protected $fileNameCorrelatedNetwork;
    protected $pointsCorrelatedNetworkSelected;

    protected $correlatedMatrix;
    protected $startingPoint;

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
    protected $appliedSampling;
        
    protected $elitismSelected;
    protected $percentOfElitism;

    protected $functionType;
    protected $alphaValue;

    protected $currentExperiment = array();
    protected $experiments = array();

    protected $execute;

    protected $generationsJson = array();
    protected $experimentsJson = array();

    public function getAppliedSampling() {
        return $this->appliedSampling;
    }

    public function getValueSampling() {
        return $this->sampling;
    }

    public function getExecute() {
        return $this->execute;
    }

    public function calculateSampling(){
        $sizeSecuence = strlen($this->hpSecuence);
        if($this->sampling == 1) {
            // Verificar si la cadena es muy larga y son muchas generaciones            
            if($sizeSecuence > 15 && $this->generationsNumber > 400) {
                $this->sampling = 100;
                $this->appliedSampling = true;
            }
        } else {
            // Si el sampleo es diferente de 1, se verifica que si son parametros muy grandes
            // se verifica si el sampleo es de menor de 100, entonces se aplica minimo de 100
            if($sizeSecuence > 15 && $this->generationsNumber > 400) {
                if($this->sampling < 100) {
                    $this->sampling = 100;
                    $this->appliedSampling = true;
                } else {
                    $this->appliedSampling = true;
                }                
            } else {
                // Si no, solo se activa la bandera de sampleo aplicado
                $this->appliedSampling = true;
            }
        }
        
    }

    public function getExperiments() {
        return $this->experiments;
    }

    public function saveGenerationsJson(){        
        foreach($this->currentExperiment as $generation){
            if($generation != null){                
                array_push($this->generationsJson,  $generation->convertToJson());
            }
        }

        $this->currentExperiment = array();
    }

    public function saveExperimentsJson(){    
        array_push($this->experimentsJson, $this->generationsJson);        
        $this->generationsJson = array();
    }

    public function getExperimentsJson2(){
        return $this->experimentsJson;
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
