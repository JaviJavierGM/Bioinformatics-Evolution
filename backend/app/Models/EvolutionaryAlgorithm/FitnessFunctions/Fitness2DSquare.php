<?php

namespace App\Models\EvolutionaryAlgorithm\FitnessFunctions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fitness2DSquare extends Model
{
    use HasFactory;
    private $points = array();

    public function __construct($points) {
        $this->points = $points;
    }

    public function getFitnessDillModel() {
        echo '<br>resultado del modelo de DIll<br>';
    }

    public function getFitnessConvexFunction() {
        echo '<br>resultado del modelo de la funcion convexa<br>';
    }
}
