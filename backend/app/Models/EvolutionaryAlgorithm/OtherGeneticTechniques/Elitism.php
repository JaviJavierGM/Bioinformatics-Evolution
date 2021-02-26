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
        $sizeGeneration = $this->generation->getSizeGeneration();
        // $percentConformationsElitism es el numero de conformaciones a preservar con el elitismo
        $percentConformationsElitism = round( (($this->percentOfElitism / 100) * $sizeGeneration), null, PHP_ROUND_HALF_DOWN);
        $orderedConformations = $this->generation->getOrderedConformations(false);

        echo " > Fitness de las conformaciones, ordenadas de forma descendente: <br>"; 
        for($i=0; $i<$sizeGeneration; $i++){
            echo "conformations[".$i."] = ".$orderedConformations[$i]->getFitness()." <br>";
        }

        echo " > Porcentaje de conformaciones a salvar con elitismo: ".$this->percentOfElitism."% que son ".$percentConformationsElitism." conformaciones <br>";

        // Guardamos el numero de mejores conformaciones obtenidas con el elitismo,
        // en las conformaciones seleccionadas
        for($i=0; $i<$percentConformationsElitism; $i++){
            array_push($this->selectedConformations, $orderedConformations[$i]);
        }

        // Obtenemos las conformaciones faltantes por seleccionar con ayuda del operador
        // de seleccion elegido
        switch ($this->selectionOperator) {
            case "roulette":
                $this->caseRoulette($sizeGeneration, $percentConformationsElitism);
                break;

            case "tournament":
                $this->caseTournament($sizeGeneration, $percentConformationsElitism);
                break;

            case "top_percent":
                $this->caseTopPercent($sizeGeneration, $percentConformationsElitism);
                break;

            case "population_decimation";
                $this->casePopulationDecimation($sizeGeneration, $percentConformationsElitism);
                break;
        }

        echo " > Fitness de las Conformaciones seleccionadas, luego de aplicar un porcentaje: ".$this->percentOfElitism."% de elitismo y ".$this->selectionOperator." <br>";
        for($i=0; $i<$sizeGeneration; $i++){
            // var_dump($this->selectedConformations[$i]->getFitness());
            echo "selectedConformation[".$i."]= ".$this->selectedConformations[$i]->getFitness()."<br>";
        }

        unset($sizeGeneration, $percentConformationsElitism, $orderedConformations);

    }

    public function caseRoulette($sizeGeneration, $percentConformationsElitism){
        // Utilizamos la ruleta para generar las conformaciones seleccionadas que hacen falta
        $ruleta = new Roulette($this->generation);
        $ruleta->execute($sizeGeneration - $percentConformationsElitism);
        // Guardamos las conformaciones obtenidas con la ruleta, en las conformaciones seleccionadas
        foreach($ruleta->getSelectedConformations() as $conformation){
            array_push($this->selectedConformations, $conformation);
        }
        unset($ruleta);
    }

    public function caseTournament($sizeGeneration, $percentConformationsElitism){
        // Utilizamos tournament para generar las conformaciones seleccionadas que hacen falta
        $tournament = new Tournament($this->generation, $this->percentOfSelectionOperator);
        $tournament->execute($sizeGeneration - $percentConformationsElitism);
        // Guardamos las conformaciones obtenidas con el toreno, en las conformaciones seleccionadas
        foreach($tournament->getSelectedConformations() as $conformation){
            array_push($this->selectedConformations, $conformation);
        }
        unset($tournament);
    }

    public function caseTopPercent($sizeGeneration, $percentConformationsElitism){
        // Utilizamos tournament para generar las conformaciones seleccionadas que hacen falta
        $topPercent = new TopPercent($this->generation, $this->percentOfSelectionOperator);
        $topPercent->execute($sizeGeneration - $percentConformationsElitism);
        // Guardamos las conformaciones obtenidas con el toreno, en las conformaciones seleccionadas
        foreach($topPercent->getSelectedConformations() as $conformation){
            array_push($this->selectedConformations, $conformation);
        }
        unset($topPercent);
    }

    public function casePopulationDecimation($sizeGeneration, $percentConformationsElitism){
        echo "Pendiente!";
    }

}
