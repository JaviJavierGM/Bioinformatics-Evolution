<?php

namespace App\Models\EvolutionaryAlgorithm\FitnessFunctions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helpers;

class Fitness3DCubic extends Model
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
        
        // Verificación del primer punto
        $point = $this->points[0];
        $this->nextPosition = $this->points[1]->getMovVectorValue();

        if($point->getLetter() == 'H') {
            if($this->nextPosition == 0) {
                // Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia la derecha
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia la izquierda
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaHH -= 1;
                }
            } elseif($this->nextPosition == 1) {
                // Verificación hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia la derecha
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia la izquierda
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
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

                // Verificación hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia la derecha
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia la izquierda
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaHH -= 1;
                }
            } elseif($this->nextPosition == 3) {
                // Verificación hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia la derecha
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia la izquierda
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaHH -= 1;
                }
            } elseif($this->nextPosition == 4) {
                // Verificación hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia la izquierda
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaHH -= 1;
                }
            } elseif($this->nextPosition == 5) {
                // Verificación hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia la derecha
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaHH -= 1;
                }
            }
        }

        // Verificación del ultimo punto
        $point = $this->points[$pointsSize-1];
        $this->actualPosition = $point->getMovVectorValue();

        if($point->getLetter() == 'H') {
            echo 'Im H xD';
        }

        
        var_dump($this->alphaHH);
        die();
        return -2.5;
    }

    public function getFitnessConvexFunction($alphaValue) {
        echo 'Fitness Function Convex Model<br>';

        return -2 + $this->getFitnessConvexFunctionPolar($alphaValue);
    }

    private function getFitnessConvexFunctionPolar($alphaValue) {
        echo 'POLAR CONVEX xD <br>';

        return -0.2;
    }
}
