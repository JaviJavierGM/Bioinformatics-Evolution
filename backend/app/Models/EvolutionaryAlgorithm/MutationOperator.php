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
    protected $space_type;
    protected $correlatedMatrix;

    public function __construct($mutation_probability, $dimension_type, $space_type, $correlatedMatrix) {
        $this->mutation_probability = $mutation_probability;
        $this->dimension_type = $dimension_type;
        $this->space_type = $space_type;
        $this->correlatedMatrix = $correlatedMatrix;
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

    public function checkSquareChildren($pointsChildrenCopy, $movVectorValue, $pointsChildren, $j) {
        $isOk = false;
        $stringBuilder = "";

        if($this->space_type == 'correlated') {
            $widthMatrix = sizeof($this->correlatedMatrix);
            $heightMatrix = sizeof($this->correlatedMatrix[0]);
            $pointsMatrix = $this->correlatedMatrix;
            
            do{
                $generateSquarePoint = new GenerateSquarePoints(null, null, null, null, null, null);
                $point = $generateSquarePoint->generateSquarePoint($movVectorValue, 'H', $pointsChildren[$j-1]);
                
                switch ($movVectorValue) {
                    case 0:
                        if((int)($pointsChildren[$j-1]->getValueX()) < ($widthMatrix-1)) {

                        }
                        break;
                    
                    default:
                        # code...
                        break;
                }
            } while ( !$isOk );
        }
    }
}
