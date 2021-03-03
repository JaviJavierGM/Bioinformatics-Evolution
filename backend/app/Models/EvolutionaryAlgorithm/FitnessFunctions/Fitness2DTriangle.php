<?php

namespace App\Models\EvolutionaryAlgorithm\FitnessFunctions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helpers;

class Fitness2DTriangle extends Model
{
    use HasFactory;
    private $points = array();
    private $actualPosition = 0;
    private $nextPosition = 0;
    private $alphaHH = 0.0;
    private $alphaPP = 0.0;

    public function __construct($points) {
        $this->points = $points;
    }

    public function getFitnessDillModel() {
        $this->alphaHH = 0.0;
        $pointsSize = sizeof($this->points);
        
        // Verificacón del primer punto
        $point = $this->points[0];
        $this->nextPosition = $this->points[1]->getMovVectorValue();
        
        if($point->getLetter() == 'H') {
            if($this->nextPosition == 0) {
                // Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia arriba-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia abajo-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia arriba-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia abajo-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }
            } elseif($this->nextPosition == 1) {
                // Verificación hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia arriba-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia abajo-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia arriba-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia abajo-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }
            } elseif($this->nextPosition == 2) {
                // Verificación hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia abajo-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia arriba-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia abajo-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }
            } elseif($this->nextPosition == 3) {

            } elseif($this->nextPosition == 4) {

            } elseif($this->nextPosition == 5) {

            }
        }

        var_dump($this->nextPosition);
        die();

    }

    public function getFitnessConvexFunction($alphaValue) {
        return 0.25;
    }

    private function getFitnessConvexFunctionPolar($alphaValue) {
        return -14;
    }
}
