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
                // Verificación hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia arriba-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
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
            } elseif($this->nextPosition == 4) {
                // Verificación hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

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

                // Verificación hacia abajo-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
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
            }
        }

        // Verificación del  ultimo punto
        $point = $this->points[$pointsSize-1];
        $this->actualPosition = $point->getMovVectorValue();

        if($point->getLetter() == 'H') {
            if($this->actualPosition == 0) {
                // Verificación hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia abajo-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia abajo-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia arriba-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia arriba-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }
            } elseif($this->actualPosition == 1) {
                // Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia abajo-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia abajo-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia arriba-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia arriba-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()+1, $point->getValueZ())) {
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

                // Verificación hacia abajo-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia arriba-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia arriba-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()+1, $point->getValueZ())) {
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

                // Verificación hacia abajo-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia abajo-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia arriba-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
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

                // Verificación hacia abajo-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia arriba-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia arriba-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()+1, $point->getValueZ())) {
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

                // Verificación hacia abajo-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia abajo-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                // Verificación hacia arriba-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
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
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia arriba-adelante
                        if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
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
                    } elseif($this->nextPosition == 4) {
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

                        // Verificación hacia abajo-atras
                        if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    } elseif($this->nextPosition == 5) {
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
                    }
                } elseif($this->actualPosition == 1) {
                    if($this->nextPosition == 1) {
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
                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia arriba-adelante
                        if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
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
                    } elseif($this->nextPosition == 4) {
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

                        // Verificación hacia abajo-atras
                        if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    } elseif($this->nextPosition == 5) {
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
                    }
                } elseif($this->actualPosition == 2) {
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
                    } elseif($this->nextPosition == 3) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia arriba-adelante
                        if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia arriba-atras
                        if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()+1, $point->getValueZ())) {
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

                        // Verificación hacia arriba-adelante
                        if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia abajo-adelante
                        if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    }
                } elseif($this->actualPosition == 3) {
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

                        // Verificación hacia abajo-atras
                        if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
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

                        // Verificación hacia arriba-adelante
                        if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia abajo-atras
                        if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
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

                        // Verificación hacia arriba-adelante
                        if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia abajo-adelante
                        if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    }
                } elseif($this->actualPosition == 4) {
                    if($this->nextPosition == 0) {
                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia arriba-adelante
                        if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
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

                        // Verificación hacia arriba-atras
                        if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia abajo-atras
                        if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
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

                        // Verificación hacia arriba-adelante
                        if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia abajo-atras
                        if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
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

                        // Verificación hacia arriba-adelante
                        if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia arriba-atras
                        if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    }
                } elseif($this->actualPosition == 5) {
                    if($this->nextPosition == 0) {
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
                    } elseif($this-nextPosition == 1) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
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
                    } elseif($this-nextPosition == 3) {
                        // Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        // Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
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
                    } elseif($this-nextPosition == 4) {
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

                        // Verificación hacia abajo-atras
                        if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    } elseif($this-nextPosition == 5) {
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
                    }
                }
            }
        }
        
        return (int) ($this->alphaHH/2);
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

                // Verificación hacia arriba-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            } elseif($this->nextPosition == 1) {
                // Verificación hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
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

                // Verificación hacia abajo-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
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

                // Verificación hacia arriba-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
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

                // Verificación hacia arriba-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
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

                // Verificación hacia arriba-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()+1, $point->getValueZ())) {
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

                // Verificación hacia abajo-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            } elseif($this->actualPosition == 1) {
                // Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()+1, $point->getValueZ())) {
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

                // Verificación hacia abajo-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()+1, $point->getValueZ())) {
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

                // Verificación hacia abajo-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
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

                // Verificación hacia abajo-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()+1, $point->getValueZ())) {
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

                // Verificación hacia abajo-adelante
                if(Helpers::isH($this->points, $point->getValueX()+0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia abajo-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificación hacia arriba-atras
                if(Helpers::isH($this->points, $point->getValueX()-0.5, $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            }
        }

        // Verificación de los puntos intermedios

        var_dump($this->actualPosition);

        var_dump($this->alphaHH);
        die();
        
    }

    private function getFitnessConvexFunctionPolar($alphaValue) {
        return -14;
    }
}
