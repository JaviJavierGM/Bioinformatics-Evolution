<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\Conformation;

class Generation extends Model
{
    use HasFactory;

    public $conformations = array();
    public $sizeGeneration;

    public function __construct($conformations) {
        $this->conformations = $conformations;
        $this->sizeGeneration = sizeof($this->conformations);

        // Llena el campo positionIndex de las conformaciones
        $i=0;
        foreach($this->conformations as $conformation){
            $conformation->setPositionIndex($i);
            $i++;
        }        
    }

    public function getConformations(){
        return $this->conformations;
    }

    public function getTotalFitness(){
        // Nos regresa el fitness total de toda la generacion,
        // pero con signo NEGATIVO
        $totalFitness=0;
        foreach($this->conformations as $conformation){
            $totalFitness+= $conformation->getFitness();
        }
        return $totalFitness;
    }

    public function getSizeGeneration(){
        return $this->sizeGeneration;
    }

    public function getOrderedConformations($order){
        // Nos regresa una copia de las conformaciones ordenadas

        $orderedConformations  = $this->conformations;
        // Si order == true ordena en forma ascendente
        if($order == true){
            rsort($orderedConformations);
        }else{
            // order == false ordena en forma descendente
            sort($orderedConformations);
        }

        return $orderedConformations;
    }

}
