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
    private $parents;

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

    public function getParents(){
        return $this->parents;
    }

    public function setParents($parents){
        $this->parents = $parents;
    }
    
    public function getPointsJson() {
        $points = array();
        for ($i=0; $i < sizeof($this->points) ; $i++) { 
            $point = array(
                'xValue' => $this->points[$i]->getValueX(),
                'yValue' => $this->points[$i]->getValuey(),
                'zValue' => $this->points[$i]->getValueZ(),
                'letter' => $this->points[$i]->getLetter(),
                'movVectorValue' => $this->points[$i]->getMovVectorValue()
            );
            array_push($points, $point);
        }
        return $points;
    }

}
