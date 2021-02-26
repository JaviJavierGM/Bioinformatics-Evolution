<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conformation extends Model
{
    use HasFactory;

    public $fitness; // no mover de lugar (por la parte del ordenamiento)
    // A partir de aqui, colocar los demás atributos
    public $positionIndex;

    public function __construct($fitness){
        $this->fitness = $fitness;
    }

    public function getFitness(){
        return $this->fitness;
    }

    public function setFitness($fitness){
        $this->fitness = $fitness;
    }

    public function setPositionIndex($position){
        $this->positionIndex = $position;
    }

    public function getPositionIndex(){
        return $this->positionIndex;
    }

}
