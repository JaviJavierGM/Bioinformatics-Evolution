<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\FitnessFunctions\Fitness2DSquare;
use App\Models\EvolutionaryAlgorithm\FitnessFunctions\Fitness2DTriangle;
use App\Models\EvolutionaryAlgorithm\FitnessFunctions\Fitness3DCubic;

class Fitness extends Model
{
    use HasFactory;

    private $points = array();
    private $dimension_type;
    private $function_type;

    public function __construct($points, $dimension_type, $function_type) {
        $this->points = $points;
        $this->dimension_type = $dimension_type;
        $this->function_type = $function_type;
    }

    public function getFitness() {
        if($this->dimension_type == '2D_Square') { // Fitness para la dimension 2D Cuadrada
            echo '<br>Es un espacio 2d Square<br>';
            if($this->function_type == 'dill_model') { // Fitnes implentando la funcion del modelo de DILL
                echo '<br/>Entro a la funcion del modelo de DILL<br/>';
                $fitness = new Fitness2DSquare($this->points);
                return $fitness->getFitnessDillModel();
            } else { // Fitnes implentando la funcion Convexa
                echo '<br/>Entro a la funcion Convexa<br/>';
                $fitness = new Fitness2DSquare($this->points);
                return $fitness->getFitnessConvexFunction(0.2);
            }
        } elseif($this->dimension_type == '2D_Triangle') { // Fitness para la dimension 2D Traignular
            echo '<br>Es un espacio 2d  Traingle<br>';
        } elseif ($this->dimension_type == '3D_Cubic') { // Fitness para la dimension 3D Cubica
            echo '<br>Es un espacio 3D Cubic<br>';
        } else {
            echo 'Fitness';
            return 0;
        }
    }
}
