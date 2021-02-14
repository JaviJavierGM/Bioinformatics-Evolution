<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\Conformation;

class Generation extends Model
{
    use HasFactory;

    public $conformations = array();

    public function __construct(){
        
    }

    public function setConformations($conformations){
        $this->conformations = $conformations;
    }

    public function getConformations(){
        return $this->conformations;
    }

    public function add1Conformation($conformation){
        array_push($generation, $conformation);
    }

    public function getTotalFitness(){
        $totalFitness=0;
        foreach($this->conformations as $conformation){
            $totalFitness+= $conformation->getFitness();
        }
        return $totalFitness;
    }

}
