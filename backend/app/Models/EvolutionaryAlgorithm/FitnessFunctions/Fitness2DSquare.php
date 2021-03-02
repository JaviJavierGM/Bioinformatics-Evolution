<?php

namespace App\Models\EvolutionaryAlgorithm\FitnessFunctions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\Point;
use App\Helpers\Helpers;

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
        $this->fitnessCount = 0;
        $this->alphaHH = 0.0;        
        $pointsSize = sizeof($this->points);

        $point = $this->points[0];
        $this->nextPosition = $this->points[1]->getMovVectorValue();

        if($point->getLetter() == 'H') {
            if($this->nextPosition == 0) { 
                //Verificación hacia atras                
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;                    
                }
                
                //Verificación hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }
            } elseif($this->nextPosition == 1) {
                //Verificación hacia delante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }
            } elseif($this->nextPosition == 2) {
                //Verificación hacia delante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }
            } elseif($this->nextPosition == 3) {
                //Verificación hacia delante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
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
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }
            } elseif($this->actualPosition == 1) {
                //Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }
            } elseif($this->actualPosition == 2) {
                //Verificación hacia delante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }                
            } elseif($this->actualPosition == 3) {
                //Verificación hacia delante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH -= 1;
                }

                //Verificación hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
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
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    } elseif($this->nextPosition == 2) {
                        //Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    } elseif($this->nextPosition == 3) {
                        //Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    }
                } elseif($this->actualPosition == 1) {
                    if($this->nextPosition == 1) {
                        //Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    } elseif($this->nextPosition == 2) {
                        //Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                    } elseif($this->nextPosition == 3) {
                        //Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    }

                } elseif($this->actualPosition == 2) {
                    if($this->nextPosition == 0) {
                        //Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    } elseif($this->nextPosition == 1) {
                        //Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    } elseif($this->nextPosition == 2) {
                        //Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    }

                } elseif($this->actualPosition == 3) {
                    if($this->nextPosition == 0) {
                        //Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    } elseif($this->nextPosition == 1) {
                        //Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }
                    } elseif($this->nextPosition == 3) {
                        //Verificación hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH -= 1;
                        }

                        //Verificación hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
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

        // Verificación del primer Punto
        $point = $this->points[0];
        $this->nextPosition = $this->points[1]->getMovVectorValue();
        if($point->getLetter() == 'H') {
            if($this->nextPosition == 0) {
                // Verificacion hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificacion hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificacion hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            } elseif($this->nextPosition == 1) {
                // Verificacion hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificacion hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificacion hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            } elseif($this->nextPosition == 2) {
                // Verificacion hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificacion hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificacion hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            } elseif($this->nextPosition == 3) {
                // Verificacion hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificacion hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificacion hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            }
        }

        // Verificación del ultimo Punto
        $point = $this->points[$pointsSize - 1];
        $this->actualPosition = $point->getMovVectorValue();
        
        if($point->getLetter() == 'H') {
            if($this->actualPosition == 0) {
                // Verificacion hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificacion hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificacion hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            } elseif($this->actualPosition == 1) {
                // Verificacion hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificacion hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificacion hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            } elseif($this->actualPosition == 2) {
                // Verificacion hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificacion hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificacion hacia arriba
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }
            } elseif($this->actualPosition == 3) {
                // Verificacion hacia adelante
                if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificacion hacia atras
                if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaHH += ($alphaValue - 1);
                }

                // Verificacion hacia abajo
                if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
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
                        // Verificacion hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificacion hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 2) {
                        // Verificacion hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificacion hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 3) {
                        // Verificacion hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificacion hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } 
                } elseif($this->actualPosition == 1) {
                    if($this->nextPosition == 1) {
                        // Verificacion hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificacion hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 2) {
                        // Verificacion hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificacion hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 3) {
                        // Verificacion hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificacion hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } 
                } elseif($this->actualPosition == 2) {
                    if($this->nextPosition == 0) {
                        // Verificacion hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificacion hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 1) {
                        // Verificacion hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificacion hacia arriba
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 2) {
                        // Verificacion hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificacion hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } 
                } elseif($this->actualPosition == 3) {
                    if($this->nextPosition == 0) {
                        // Verificacion hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificacion hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 1) {
                        // Verificacion hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificacion hacia abajo
                        if(Helpers::isH($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } elseif($this->nextPosition == 3) {
                        // Verificacion hacia adelante
                        if(Helpers::isH($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }

                        // Verificacion hacia atras
                        if(Helpers::isH($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                            $this->alphaHH += ($alphaValue - 1);
                        }
                    } 
                }
            }
        }
        
        $this->alphaHH /= 2;

        $alpha = $this->alphaHH + $this->getFitnessConvexFunctionPolar($alphaValue);
        var_dump($alpha);
        die();
    }

    private function getFitnessConvexFunctionPolar($alphaValue) {
        echo '<br>'.$alphaValue.'<br>';
        $this->alphaPP = 0.0;
        $pointsSize = sizeof($this->points);

        // Verificación del primer punto
        $point = $this->points[0];
        $this->nextPosition = $this->points[1]->getMovVectorValue();

        if($point->getLetter() == 'P') {
            if($this->nextPosition == 0) {
                // Verificacion hacia atras
                if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificacion hacia arriba
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificacion hacia abajo
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }
            } elseif($this->nextPosition == 1) {
                // Verificacion hacia adelante
                if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificacion hacia arriba
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificacion hacia abajo
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }
            } elseif($this->nextPosition == 2) {
                // Verificacion hacia adelante
                if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificacion hacia atras
                if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificacion hacia abajo
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()-1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }
            } elseif($this->nextPosition == 3) {
                // Verificacion hacia adelante
                if(Helpers::isP($this->points, $point->getValueX()+1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificacion hacia atras
                if(Helpers::isP($this->points, $point->getValueX()-1, $point->getValueY(), $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }

                // Verificacion hacia arriba
                if(Helpers::isP($this->points, $point->getValueX(), $point->getValueY()+1, $point->getValueZ())) {
                    $this->alphaPP += (-($alphaValue));
                }
            }
        }

        // Verificación del ultimo punto

        var_dump($point);
        var_dump($this->nextPosition);
        die();

        return 2.5/2;
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

    private function isP($xValue, $yValue, $zValue) {
        $this->isPolar = false;

        foreach ($this->points as $point) {
            if(($this->compare($point->getValueX(), $xValue) == 0) && ($this->compare($point->getValueY(), $yValue) == 0) && ($this->compare($point->getValueZ(), $zValue) == 0) && ($point->getLetter() == 'P')) {
                $this->isPolar = true;
                break;
            }
        }
        return $this->isPolar;
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
