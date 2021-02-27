<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\GeneratePointsTypes\GenerateCubePoints;
use App\Models\EvolutionaryAlgorithm\GeneratePointsTypes\GenerateSquarePoints;
use App\Models\EvolutionaryAlgorithm\GeneratePointsTypes\GenerateTrianglePoints;

abstract class MutationOperator extends Model
{
    use HasFactory;
    protected $mutation_probability;
    protected $dimension_type;

    public function __construct($mutation_probability, $dimension_type) {
        $this->mutation_probability = $mutation_probability;
        $this->dimension_type = $dimension_type;
        srand($this->make_seed());
    }

    public function execute($conformation) {
        if($this->mutation_probability > $this->decimalRandom()) {
            echo '<br/>Se realiza la mutacion: ';
            if($this->dimension_type == '2D_Square' || $this->dimension_type == '2D_Square_Correlated') {
                echo 'Se generaran puntos 2D Cuadrado xD!<br/>';
                //$point = new GenerateSquarePoints()
            } elseif($this->dimension_type == '2D_Triangle' || $this->dimension_type == '2D_Triangle_Correlated') {
                echo 'Se generaran puntos 2D Traingular xD!<br/>';
                //$point = new GenerateTrianglePoints();
            } else {
                echo 'Se generaran puntos 3D Cubico xD!<br/>';
                //$point = new GenerateCubePoints();
            }            
        } else {
            echo '<br/>No se realiza la mutacion<br/>';
        }
    }

    public function make_seed() {
        list($usec, $sec) = explode(' ', microtime());
        return (float) $sec + ((float) $usec * 100000);
    }

    public function decimalRandom() {
        return rand(0, 1000000) / 1000000;
    }
}
