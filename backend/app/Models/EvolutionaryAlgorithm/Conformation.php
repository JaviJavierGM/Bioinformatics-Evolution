<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conformation extends Model
{
    use HasFactory;

    public $fitness;

    public function __construct($fitness){
        $this->fitness = $fitness;
    }

    public function getFitness(){
        return $this->fitness;
    }

    public function setFitness($fitness){
        $this->fitness = $fitness;
    }

}
