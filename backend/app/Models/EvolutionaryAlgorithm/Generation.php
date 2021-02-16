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

    public function __construct($conformations){
        $this->conformations = $conformations;
        $this->sizeGeneration = sizeof($this->conformations);
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

}
