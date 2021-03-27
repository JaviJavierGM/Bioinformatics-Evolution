<?php

namespace App\Models\EvolutionaryAlgorithm\OtherGeneticTechniques;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\Roulette;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\Tournament;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\TopPercent;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\PopulationDecimation;

class Elitism extends Model
{
    use HasFactory;

    public $percentOfElitism;
    public $generation;       
    public $selectionOperator;
    public $percentOfSelectionOperator;
    public $selectedConformations = array(); 

    public function __construct($percentOfElitism, $generation, $selectionOperator, $percentOfSelectionOperator){
        $this->percentOfElitism = $percentOfElitism;
        $this->generation = $generation;
        $this->selectionOperator = $selectionOperator;
        $this->percentOfSelectionOperator = $percentOfSelectionOperator;

    }

    public function execute(){

        $totalFitness = $this->generation->getTotalFitness() * -1;

        if($totalFitness == 0){
            return false;
        }

        $sizeGeneration = $this->generation->getSizeGeneration();
        // $percentConformationsElitism es el numero de conformaciones a preservar con el elitismo
        $percentConformationsElitism = round( (($this->percentOfElitism / 100) * $sizeGeneration), null, PHP_ROUND_HALF_DOWN);
        $orderedConformations = $this->generation->getOrderedConformations(false);

        /*
        echo " > Fitness de las conformaciones, ordenadas de forma descendente: <br>"; 
        for($i=0; $i<$sizeGeneration; $i++){
            echo "conformations[".$i."] = ".$orderedConformations[$i]->getFitness()." <br>";
        }

        echo " > Porcentaje de conformaciones a salvar con elitismo: ".$this->percentOfElitism."% que son ".$percentConformationsElitism." conformaciones <br>";
        */

        $indexSelectedConformations = array();

        // Guardamos el numero de mejores conformaciones obtenidas con el elitismo,
        // en las conformaciones seleccionadas
        for($i=0; $i<$percentConformationsElitism; $i++){
            // array_push($this->selectedConformations, $orderedConformations[$i]);
            array_push($indexSelectedConformations, $orderedConformations[$i]->getPositionIndex());
            // var_dump($orderedConformations[$i]->getPositionIndex());
            // var_dump($orderedConformations[$i]->getFitness());
        }

        // Obtenemos las conformaciones que faltan por seleccionar con ayuda del operador de seleccion elegido
        switch ($this->selectionOperator) {
            case "roulette":
                $this->caseRoulette($sizeGeneration, $percentConformationsElitism, $indexSelectedConformations);
                break;

            case "tournament":
                $this->caseTournament($sizeGeneration, $percentConformationsElitism, $indexSelectedConformations);
                break;

            case "top_percent":
                $this->caseTopPercent($sizeGeneration, $percentConformationsElitism, $indexSelectedConformations);
                break;

            case "population_decimation";
                $this->casePopulationDecimation($sizeGeneration, $percentConformationsElitism, $indexSelectedConformations);
                break;
        }

        sort($indexSelectedConformations);

        $this->generation->setIndexSelectedConformations($indexSelectedConformations);
        
        /*
        echo " > Fitness de las Conformaciones seleccionadas, luego de aplicar un porcentaje: ".$this->percentOfElitism."% de elitismo y ".$this->selectionOperator." <br>";
        for($i=0; $i<$sizeGeneration; $i++){
            echo "selectedConformation[".$i."]= ".$this->generation->getSelectedConformations()[$i]->getFitness()."<br>";
        }
        */

        unset($sizeGeneration, $percentConformationsElitism, $orderedConformations, $indexSelectedConformations);

        return true;

    }

    public function caseRoulette($sizeGeneration, $percentConformationsElitism, &$indexSelectedConformations){
        // Utilizamos la ruleta para generar las conformaciones seleccionadas que hacen falta
        $ruleta = new Roulette($this->generation);
        $ruleta->execute($sizeGeneration - $percentConformationsElitism);
        // Guardamos las conformaciones obtenidas con la ruleta, en las conformaciones seleccionadas
        foreach($this->generation->getSelectedConformations() as $conformation){            
            array_push($indexSelectedConformations, $conformation->getPositionIndex());
        }
        unset($ruleta);
    }

    public function caseTournament($sizeGeneration, $percentConformationsElitism, &$indexSelectedConformations){
        // Utilizamos tournament para generar las conformaciones seleccionadas que hacen falta
        $tournament = new Tournament($this->generation, $this->percentOfSelectionOperator);
        $tournament->execute($sizeGeneration - $percentConformationsElitism);
        // Guardamos las conformaciones obtenidas con el torneo, en las conformaciones seleccionadas
        foreach($this->generation->getSelectedConformations() as $conformation){
            array_push($indexSelectedConformations, $conformation->getPositionIndex());
        }
        unset($tournament);
    }

    public function caseTopPercent($sizeGeneration, $percentConformationsElitism, &$indexSelectedConformations){
        // Utilizamos top percent para generar las conformaciones seleccionadas que hacen falta
        $topPercent = new TopPercent($this->generation, $this->percentOfSelectionOperator);
        $topPercent->execute($sizeGeneration - $percentConformationsElitism);
        // Guardamos las conformaciones obtenidas con el top percent, en las conformaciones seleccionadas
        foreach($this->generation->getSelectedConformations() as $conformation){
            array_push($indexSelectedConformations, $conformation->getPositionIndex());
        }
        unset($topPercent);
    }

    public function casePopulationDecimation($sizeGeneration, $percentConformationsElitism, &$indexSelectedConformations){
        // Utilizamos pop decimation para generar las conformaciones seleccionadas que hacen falta
        $popDecimation = new PopulationDecimation($this->generation);
        $popDecimation->execute($sizeGeneration - $percentConformationsElitism);
        // Guardamos las conformaciones obtenidas con el pop decimation, en las conformaciones seleccionadas
        foreach($this->generation->getSelectedConformations() as $conformation){
            array_push($indexSelectedConformations, $conformation->getPositionIndex());
        }
        unset($topPercent);
    }

}
