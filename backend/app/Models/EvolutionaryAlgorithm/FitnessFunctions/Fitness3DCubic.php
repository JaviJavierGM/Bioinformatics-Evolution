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
            if($this->actualPosition == 0) {
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
            } elseif($this->actualPosition == 1) {
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
            } elseif($this->actualPosition == 2) {
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
            } elseif($this->actualPosition == 3) {
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
            } elseif($this->actualPosition == 4) {
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
            } elseif($this->actualPosition == 5) {
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
            }
        }

        // Verificación de los puntos intermedios.
        for($i=1; $i < $pointsSize-1; $i++) {
            $point = $this->points[$i];
            if($point->getLetter() == 'H') {
                $this->actualPosition = $point->getMovVectorValue();
                $this->nextPosition = $this->points[$i+1]->getMovVectorValue();

                if($this->actualPosition == 0) {
                    if($this->nextPosition == 0) {
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
                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
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
                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaHH -= 1;
                        }
                    } elseif($this->nextPosition == 5) {
                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH -= 1;
                        }
                    }
                } elseif($this->actualPosition == 1) {
                    if($this->nextPosition == 1) {
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
                } elseif($this->actualPosition == 2) {
                    if($this->nextPosition == 0) {
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
                    } elseif($this->nextPosition == 1) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
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
                    } elseif($this->nextPosition == 2) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
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

                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH -= 1;
                        }
                    }
                } elseif($this->actualPosition == 3) {
                    if($this->nextPosition == 0) {
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
                    } elseif($this->nextPosition == 1) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
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

                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH -= 1;
                        }
                    }
                } elseif($this->actualPosition == 4) {
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
                    }
                } elseif($this->actualPosition == 5) {
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

                        // Verificación hacia la abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    }
                }
            }
        }
        
        return (int)($this->alphaHH/2);
    }

    public function getFitnessConvexFunction($alphaValue) {
        $this->alphaHH = 0.0;
        $pointsSize = sizeof($this->points);

        // Verificación del primer punto
        $point = $this->points[0];
        $this->nextPosition = $this->points[1]->getMovVectorValue();

        if($point->getLetter() == 'H') {
            if($this->nextPosition == 0) {
                // Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia la derecha
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia la izquierda
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            } elseif($this->nextPosition == 1) {
                // Verificación hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia la derecha
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia la izquierda
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            } elseif($this->nextPosition == 2) {
                // Verificación hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia la derecha
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia la izquierda
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            } elseif($this->nextPosition == 3) {
                // Verificación hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia la derecha
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia la izquierda
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            } elseif($this->nextPosition == 4) {
                // Verificación hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia la izquierda
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            } elseif($this->nextPosition == 5) {
                // Verificación hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia la derecha
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            }
        }

        // Verificación del ultimo punto
        $point = $this->points[$pointsSize-1];
        $this->actualPosition = $point->getMovVectorValue();

        if($point->getLetter() == 'H') {
            if($this->actualPosition == 0) {
                // Verificación hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia la derecha
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia la izquierda
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            } elseif($this->actualPosition == 1) {
                // Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia la derecha
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia la izquierda
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            } elseif($this->actualPosition == 2) {
                // Verificación hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia la derecha
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia la izquierda
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            } elseif($this->actualPosition == 3) {
                // Verificación hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia la derecha
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia la izquierda
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            } elseif($this->actualPosition == 4) {
                // Verificación hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia la derecha
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            } elseif($this->actualPosition == 5) {
                // Verificación hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia la izquierda
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            }
        }

        // Verificación de los puntos intermedios
        for($i=1; $i < $pointsSize-1; $i++) {
            $point = $this->points[$i];
            
            if($point->getLetter() == 'H') {
                $this->actualPosition = $point->getMovVectorValue();
                $this->nextPosition = $this->points[$i+1]->getMovVectorValue();
                
                if($this->actualPosition == 0) {
                    if($this->nextPosition == 0) {
                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 2) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                        
                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 3) {
                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                        
                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 4) {
                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                        
                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 5) {
                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                        
                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    }
                } elseif($this->actualPosition == 1) {
                    if($this->nextPosition == 1) {
                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 2) {
                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 3) {
                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 4) {
                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 5) {
                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    }
                } elseif($this->actualPosition == 2) {
                    if($this->nextPosition == 0) {
                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 1) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 2) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 4) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 5) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    }
                } elseif($this->actualPosition == 3) {
                    if($this->nextPosition == 0) {
                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 1) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 3) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 4) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 5) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    }
                } elseif($this->actualPosition == 4) {
                    if($this->nextPosition == 0) {
                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 1) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 2) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 3) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 4) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    }
                } elseif($this->actualPosition == 5) {
                    if($this->nextPosition == 0) {
                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 1) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 2) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 3) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 5) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    }
                }
            }
        }

        $this->alphaHH /= 2;
        $alpha = $this->alphaHH + $this->getFitnessConvexFunctionPolar($alphaValue);
        return ($alpha);
    }

    private function getFitnessConvexFunctionPolar($alphaValue) {
        $this->alphaPP = 0.0;
        $pointsSize = sizeof($this->points);

        // Verificación del primer punto
        $point = $this->points[0];
        $this->nextPosition = $this->points[1]->getMovVectorValue();

        if($point->getLetter() == 'P'){
            if($this->nextPosition == 0) {
                // Verificación hacia atras
                if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia arriba
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia abajo
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia la derecha
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia la izquierda
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaPP += (-($alphaValue));
                }
            } elseif($this->nextPosition == 1) {
                // Verificación hacia adelante
                if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia arriba
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia abajo
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia la derecha
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia la izquierda
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaPP += (-($alphaValue));
                }
            } elseif($this->nextPosition == 2) {
                // Verificación hacia adelante
                if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia atras
                if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia abajo
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia la derecha
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia la izquierda
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaPP += (-($alphaValue));
                }
            } elseif($this->nextPosition == 3) {
                // Verificación hacia adelante
                if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia atras
                if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia arriba
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia la derecha
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia la izquierda
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaPP += (-($alphaValue));
                }
            } elseif($this->nextPosition == 4) {
                // Verificación hacia adelante
                if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia atras
                if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia arriba
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia abajo
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia la izquierda
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaPP += (-($alphaValue));
                }
            } elseif($this->nextPosition == 5) {
                // Verificación hacia adelante
                if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia atras
                if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia arriba
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia abajo
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia la derecha
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaPP += (-($alphaValue));
                }
            }
        }

        // Verificación del ultimo punto
        $point = $this->points[$pointsSize-1];
        $this->actualPosition = $point->getMovVectorValue();

        if($point->getLetter() == 'P') {
            if($this->actualPosition == 0) {
                // Verificación hacia adelante
                if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia arriba
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia abajo
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia la derecha
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia la izquierda
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaPP += (-($alphaValue));
                }
            } elseif($this->actualPosition == 1) {
                // Verificación hacia atras
                if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia arriba
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia abajo
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia la derecha
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia la izquierda
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaPP += (-($alphaValue));
                }
            } elseif($this->actualPosition == 2) {
                // Verificación hacia adelante
                if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia atras
                if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia arriba
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }
                
                // Verificación hacia la derecha
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia la izquierda
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaPP += (-($alphaValue));
                }
            } elseif($this->actualPosition == 3) {
                // Verificación hacia adelante
                if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia atras
                if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia abajo
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }
                
                // Verificación hacia la derecha
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia la izquierda
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaPP += (-($alphaValue));
                }
            } elseif($this->actualPosition == 4) {
                // Verificación hacia adelante
                if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia atras
                if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia arriba
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia abajo
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }
                
                // Verificación hacia la derecha
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                    $this->alphaPP += (-($alphaValue));
                }                
            } elseif($this->actualPosition == 5) {
                // Verificación hacia adelante
                if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia atras
                if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia arriba
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificación hacia abajo
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }
                
                // Verificación hacia la izquierda
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                    $this->alphaPP += (-($alphaValue));
                } 
            }
        }

        // Verificación de los puntos intermedios
        for($i=1; $i < $pointsSize-1; $i++) {
            $point = $this->points[$i];

            if($point->getLetter() == 'P') {
                $this->actualPosition = $point->getMovVectorValue();
                $this->nextPosition = $this->points[$i+1]->getMovVectorValue();

                if($this->actualPosition == 0) {
                    if($this->nextPosition == 0) {
                        // Verificación hacia arriba
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia abajo
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 2) {
                        // Verificación hacia adelante
                        if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia abajo
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 3) {
                        // Verificación hacia arriba
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia adelante
                        if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }
                        
                        // Verificación hacia la derecha
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 4) {
                        // Verificación hacia arriba
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia abajo
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia adelante
                        if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }
                                                
                        // Verificación hacia la izquierda
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 5) {
                        // Verificación hacia arriba
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia abajo
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia adelante
                        if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }
                                                
                        // Verificación hacia la derecha
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    }
                } elseif($this->actualPosition == 1) {
                    if($this->nextPosition == 1) {
                        // Verificación hacia arriba
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia abajo
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 2) {
                        // Verificación hacia atras
                        if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia abajo
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 3) {
                        // Verificación hacia atras
                        if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia arriba
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 4) {
                        // Verificación hacia atras
                        if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia arriba
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia abajo
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 5) {
                        // Verificación hacia atras
                        if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia arriba
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia abajo
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    }
                } elseif($this->actualPosition == 2) {
                    if($this->nextPosition == 0) {
                        // Verificación hacia atras
                        if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia arriba
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 1) {
                        // Verificación hacia adelante
                        if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia arriba
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 2) {
                        // Verificación hacia adelante
                        if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia atras
                        if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 4) {
                        // Verificación hacia adelante
                        if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia atras
                        if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia arriba
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 5) {
                        // Verificación hacia adelante
                        if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia atras
                        if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia arriba
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    }
                } elseif($this->actualPosition == 3) {
                    if($this->nextPosition == 0) {
                        // Verificación hacia atras
                        if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia abajo
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 1) {
                        // Verificación hacia adelante
                        if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia abajo
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 3) {
                        // Verificación hacia adelante
                        if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia atras
                        if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 4) {
                        // Verificación hacia adelante
                        if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia atras
                        if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia abajo
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 5) {
                        // Verificación hacia adelante
                        if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia atras
                        if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia abajo
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    }
                } elseif($this->actualPosition == 4) {
                    if($this->nextPosition == 0) {
                        // Verificación hacia atras
                        if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia arriba
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia abajo
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 1) {
                        // Verificación hacia adelante
                        if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia arriba
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia abajo
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 2) {
                        // Verificación hacia adelante
                        if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia atras
                        if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia abajo
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 3) {
                        // Verificación hacia adelante
                        if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia atras
                        if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia arriba
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la derecha
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()+1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 4) {
                        // Verificación hacia adelante
                        if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia atras
                        if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia arriba
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia abajo
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    }
                } elseif($this->actualPosition == 5) {
                    if($this->nextPosition == 0) {
                        // Verificación hacia atras
                        if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia arriba
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia abajo
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 1) {
                        // Verificación hacia adelante
                        if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia arriba
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia abajo
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 2) {
                        // Verificación hacia adelante
                        if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia atras
                        if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia abajo
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 3) {
                        // Verificación hacia adelante
                        if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia atras
                        if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia arriba
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia la izquierda
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY(), $point->getValueZ()-1)) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    } elseif($this->nextPosition == 5) {
                        // Verificación hacia adelante
                        if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia atras
                        if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia arriba
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }

                        // Verificación hacia abajo
                        if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaPP += (-($alphaValue));
                        }
                    }
                }
            }
        }
        
        $this->alphaPP /= 2;
        return $this->alphaPP;
    }
}
