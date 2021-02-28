<?php

namespace App\Models\EvolutionaryAlgorithm\FitnessFunctions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\Point;

class Fitness2DSquare extends Model
{
    use HasFactory;
    private $points = array();
    private $fitnessCount = 0;
    private $actualPosition = 0;
    private $nextPosition = 0;
    private $isHidro = false;
    private $isPolar = false;
    private $alphaHH = 0.0;
    private $alphaPP = 0.0;

    public function __construct($points) {
        $this->points = $points;
    }

    public function getFitnessDillModel() {
        echo '<br>resultado del modelo de DIll<br>';
        $this->fitnessCount = 0;
        $this->alphaHH = 0.0;        
        $pointsSize = sizeof($this->points);

        $point = $this->points[0];
        $this->nextPosition = $this->points[1]->getMovVectorValue();

        if($point->getLetter() == 'H') {
            if($this->nextPosition == 0) { 
                //Verificación hacia atras                
                if($this->isH($point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;                    
                }
                
                //Verificación hacia arriba
                if($this->isH($point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia abajo
                if($this->isH($point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }
            } elseif($this->nextPosition == 1) {
                //Verificación hacia delante
                if($this->isH($point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia arriba
                if($this->isH($point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia abajo
                if($this->isH($point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }
            } elseif($this->nextPosition == 2) {
                //Verificación hacia delante
                if($this->isH($point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia atras
                if($this->isH($point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia abajo
                if($this->isH($point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }
            } elseif($this->nextPosition == 3) {
                //Verificación hacia delante
                if($this->isH($point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia atras
                if($this->isH($point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia arriba
                if($this->isH($point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }
            }
        }

        // Verificación del ultimo punto
        $point = $this->points[$pointsSize-1];
        $this->actualPosition = $point->getMovVectorValue();
        if($point->getLetter() == 'H') {
            if($this->actualPosition == 0) {
                //Verificación hacia delante
                if($this->isH($point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia arriba
                if($this->isH($point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia abajo
                if($this->isH($point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }
            } elseif($this->actualPosition == 1) {
                //Verificación hacia atras
                if($this->isH($point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia arriba
                if($this->isH($point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia abajo
                if($this->isH($point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }
            } elseif($this->actualPosition == 2) {
                //Verificación hacia delante
                if($this->isH($point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia atras
                if($this->isH($point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia arriba
                if($this->isH($point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }                
            } elseif($this->actualPosition == 3) {
                //Verificación hacia delante
                if($this->isH($point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia atras
                if($this->isH($point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia abajo
                if($this->isH($point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }  
            }
        }

        // Verificación de los puntos intermedios
        for($i=1; $i < ($pointsSize-1); $i++) {
            $point = $this->points[$i];
            if($point->getLetter() == 'H') {
                $this->actualPosition = $point->getMovVectorValue();
                $this->nextPosition = $this->points[$i+1]->getMovVectorValue();
                if($this->actualPosition == 0) {
                    if($this->nextPosition == 0) {
                        //Verificación hacia arriba
                        if($this->isH($point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia abajo
                        if($this->isH($point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    } elseif($this->nextPosition == 2) {
                        //Verificación hacia adelante
                        if($this->isH($point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia abajo
                        if($this->isH($point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    } elseif($this->nextPosition == 3) {
                        //Verificación hacia adelante
                        if($this->isH($point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia arriba
                        if($this->isH($point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    }
                } elseif($this->actualPosition == 1) {
                    if($this->nextPosition == 1) {
                        //Verificación hacia arriba
                        if($this->isH($point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia abajo
                        if($this->isH($point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    } elseif($this->nextPosition == 2) {
                        //Verificación hacia atras
                        if($this->isH($point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia abajo
                        if($this->isH($point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                    } elseif($this->nextPosition == 3) {
                        //Verificación hacia atras
                        if($this->isH($point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia arriba
                        if($this->isH($point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    }

                } elseif($this->actualPosition == 2) {
                    if($this->nextPosition == 0) {
                        //Verificación hacia atras
                        if($this->isH($point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia arriba
                        if($this->isH($point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    } elseif($this->nextPosition == 1) {
                        //Verificación hacia adelante
                        if($this->isH($point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia arriba
                        if($this->isH($point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    } elseif($this->nextPosition == 2) {
                        //Verificación hacia adelante
                        if($this->isH($point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia atras
                        if($this->isH($point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    }

                } elseif($this->actualPosition == 3) {
                    if($this->nextPosition == 0) {
                        //Verificación hacia atras
                        if($this->isH($point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia abajo
                        if($this->isH($point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    } elseif($this->nextPosition == 1) {
                        //Verificación hacia adelante
                        if($this->isH($point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia abajo
                        if($this->isH($point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    } elseif($this->nextPosition == 3) {
                        //Verificación hacia adelante
                        if($this->isH($point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia atras
                        if($this->isH($point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    }
                }
            }
        }
        return (int) ($this->alphaHH/2);
    }

    public function getFitnessConvexFunction() {
        echo '<br>resultado del modelo de la funcion convexa<br>';
    }

    private function isH($xValue, $yValue, $zValue) {
        $this->isHidro = false;

        foreach ($this->points as $point) {
            if(($this->compare($point->getValueX(), $xValue) == 0) && ($this->compare($point->getValueY(), $yValue) == 0) && ($this->compare($point->getValueZ(), $zValue) == 0) && ($point->getLetter() == 'H')) {
                $this->isHidro = true;
                break;
            }
        }
        return $this->isHidro;
    }

    private function compare($firstValue, $secondValue) {
        if($firstValue == $secondValue) {
            return 0;
        } elseif ($firstValue < $secondValue) {
            return -1;
        } else {
            return 1;
        }
    }
}
