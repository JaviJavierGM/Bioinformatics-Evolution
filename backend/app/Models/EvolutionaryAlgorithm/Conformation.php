<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conformation extends Model
{
    use HasFactory;

    private $fitness; // no mover de lugar (por la parte del ordenamiento)
    // A partir de aqui, colocar los demás atributos
    private $positionIndex;
    private $points;

    public function __construct($points){
        $this->points = $points;
    }

    public function getFitness(){
        return $this->fitness;
    }

    public function setFitness($fitness){
        $this->fitness = $fitness;
    }

    public function setFitnessTo0(){
        $this->fitness = 0;
    }

    public function setPositionIndex($position){
        $this->positionIndex = $position;
    }

    public function getPositionIndex(){
        return $this->positionIndex;
    }

    public function getPoints(){
        return $this->points;
    }

}
