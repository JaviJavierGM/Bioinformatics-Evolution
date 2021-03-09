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
    private $alphaValue;

    public function __construct($points, $dimension_type, $function_type, $alphaValue) {
        $this->points = $points;
        $this->dimension_type = $dimension_type;
        $this->function_type = $function_type;
        $this->alphaValue = $alphaValue;
    }

    public function getFitness() {
        if($this->dimension_type == '2D_Square') {
            // Fitness para la dimension 2D Cuadrada
            if($this->function_type == 'dill_model') {
                // Fitnes implentando la funcion del modelo de DILL
                $fitness = new Fitness2DSquare($this->points);
                return $fitness->getFitnessDillModel();
            } else {
                // Fitnes implentando la funcion Convexa
                $fitness = new Fitness2DSquare($this->points);
                return $fitness->getFitnessConvexFunction($this->alphaValue);
            }
        } elseif($this->dimension_type == '2D_Triangle') {
            // Fitness para la dimension 2D Traignular            
            if($this->function_type == 'dill_model') {
                // Fitnes implentando la funcion del modelo de DILL
                $fitness = new Fitness2DTriangle($this->points);
                return $fitness->getFitnessDillModel();
            } else { 
                // Fitnes implentando la funcion Convexa
                $fitness = new Fitness2DTriangle($this->points);
                return $fitness->getFitnessConvexFunction($this->alphaValue);
            }
        } elseif ($this->dimension_type == '3D_Cubic') {
            // Fitness para la dimension 3D Cubica
            if($this->function_type == 'dill_model') {
                // Fitness implementando la funcion del modelo de DILL
                $fitness = new Fitness3DCubic($this->points);
                return $fitness->getFitnessDillModel();
            } else {
                // Fitness implementando la funcion convexa
                $fitness = new Fitness3DCubic($this->points);
                return $fitness->getFitnessConvexFunction($this->alphaValue);
            }
        } else {
            echo 'Default Fitness';
            return 0;
        }
    }
}
