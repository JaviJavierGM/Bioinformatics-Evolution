<?php

namespace App\Models\EvolutionaryAlgorithm\GeneratePointsTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\GeneratePoints;
use App\Models\EvolutionaryAlgorithm\Point;
use App\Helpers\Helpers;

class GenerateSquarePoints extends GeneratePoints
{
    use HasFactory;

    public function doPoints($childPoints_C, $i) {
        
        $isOk = true;
        $stringBuilder = "";
        $widthMatrix;
        $heightMatrix;

        if ($this->typeSpace == "correlated") { // 2D Cuadrada sobre un espacio correlacionado
            
            $widthMatrix = sizeof($this->correlatedMatrix);
            $heightMatrix = sizeof($this->correlatedMatrix[0]);

            do {
                switch (rand( 0, 3)) { 
                    
                    case 0: // Derecha

                        if ( ((int)$this->points[$i-1]->getValueX()) < ($widthMatrix-1) ) {                        
                            $valueMatrix = $this->correlatedMatrix[(int)$this->points[$i-1]->getValueX() + 1][(int)$this->points[$i-1]->getValueY()];
                            
                            if(strcmp($valueMatrix, "1") == 0) {
                                $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX()+1, $this->points[$i-1]->getValueY(), $this->points[$i-1]->getValueZ());;                                
                                                                                                        
                                if( $this->points[$i-1]->isWay0() && $isAvailable) {                                    
                                    array_push($this->points, Helpers::generateSquarePoint(0, $this->hpSecuence[$i], $this->points[$i-1]));                                    
                                    $isOk = true;                                
                                
                                } else {
                                    $isOk = false;
                                    $stringBuilder .= "a";

                                }
                            } else {
                                $isOk = false;
                                $stringBuilder .= "a";

                            }                        
                        } else {
                            $isOk = false;
                            $stringBuilder .= "a";

                        }
                        
                    break;

                    case 1: // Izquierda

                        if( ( (int)($this->points[$i-1]->getValueX()) ) > 0 ) {
                            $valueMatrix = $this->correlatedMatrix[ ((int)($this->points[$i-1]->getValueX())) - 1 ][ (int)($this->points[$i-1]->getValueY()) ];

                            if(strcmp($valueMatrix, "1") == 0) {
                                $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX()-1, $this->points[$i-1]->getValueY(), $this->points[$i-1]->getValueZ());                                

                                if($this->points[$i-1]->isWay1() && $isAvailable) {
                                    array_push($this->points, Helpers::generateSquarePoint(1, $this->hpSecuence[$i], $this->points[$i-1]));
                                    $isOk = true;

                                } else {
                                    $isOk = false;
                                    $stringBuilder .= "b";

                                }
                                
                            } else {
                                $isOk = false;
                                $stringBuilder .= "b";

                            }
                        } else {
                            $isOk = false;
                            $stringBuilder .= "b";
                        }

                    break;

                    case 2: // Abajo

                        if( (int)($this->points[$i-1]->getValueY() < ($heightMatrix - 1)) ) {
                            $valueMatrix = $this->correlatedMatrix[ (int)($this->points[$i-1]->getValueX()) ][ ((int)($this->points[$i-1]->getValueY()) + 1) ];                            

                            if(strcmp($valueMatrix, "1") == 0) {
                                $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX(), $this->points[$i-1]->getValueY() + 1, $this->points[$i-1]->getValueZ());

                                if($this->points[$i-1]->isWay2() && $isAvailable) {
                                    array_push($this->points, Helpers::generateSquarePoint(2, $this->hpSecuence[$i], $this->points[$i-1]));
                                    $isOk = true;                                    

                                } else {
                                    $isOk = false;
                                    $stringBuilder .= "c";

                                }
                            } else {
                                $isOk = false;
                                $stringBuilder .= "c";

                            }
                        } else {
                            $isOk = false;
                            $stringBuilder .= "c";

                        }

                    break;

                    case 3: // Arriba

                        if( (int)($this->points[$i-1]->getValueY()) > 0 ) {
                            $valueMatrix = $this->correlatedMatrix[ (int)($this->points[$i-1]->getValueX()) ][ ((int)($this->points[$i-1]->getValueY() - 1)) ];

                            if(strcmp($valueMatrix, "1") == 0) {
                                $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX(), $this->points[$i-1]->getValueY() - 1, $this->points[$i-1]->getValueZ());
                                
                                if($this->points[$i-1]->isWay3() && $isAvailable) {
                                    array_push($this->points, Helpers::generateSquarePoint(3, $this->hpSecuence[$i], $this->points[$i-1]));
                                    $isOk = true;

                                } else {
                                    $isOk = false;
                                    $stringBuilder .= "d";

                                }
                            } else {
                                $isOk = false;
                                $stringBuilder .= "d";

                            }
                            
                        } else {
                            $isOk = false;
                            $stringBuilder .= "d";

                        }

                    break;

                    default:
                        echo "doPoints - Default case";
                    break;

                }

                $indexOfA = Helpers::indexOfString($stringBuilder, "a");
                $indexOfB = Helpers::indexOfString($stringBuilder, "b");
                $indexOfC = Helpers::indexOfString($stringBuilder, "c");
                $indexOfD = Helpers::indexOfString($stringBuilder, "d");

                if($indexOfA != -1 && $indexOfB != -1 && $indexOfC != -1 && $indexOfD != -1) {

                    switch($this->points[--$i]->getMovVectorValue()) {                        
                        case 0:
                            $this->points[$i-1]->setWay0(false);                            
                        break;
                        
                        case 1:
                            $this->points[$i-1]->setWay1(false);                            
                        break;
                        
                        case 2:
                            $this->points[$i-1]->setWay2(false);
                        break;
                        
                        case 3:
                            $this->points[$i-1]->setWay3(false);                            
                        break;
                        
                        default:
                            echo "Default case";
                        break;
                    }

                    array_push($childPoints_C, $this->points[$i]);                    
                    unset($this->points[$i]);
                    $this->points = array_values($this->points);
                    $stringBuilder = "";

                }

            } while ( !$isOk );
            
            return $i;

        } else { // 2D Cuadrada sobre un espacio homogeneo
            
            do {
                
                switch (rand( 0, 3)) {

                    case 0:

                        $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX() + 1, $this->points[$i-1]->getValueY(), $this->points[$i-1]->getValueZ());

                        if($this->points[$i-1]->isWay0() && $isAvailable) {
                            array_push($this->points, Helpers::generateSquarePoint(0, $this->hpSecuence[$i], $this->points[$i-1]));
                            $isOk = true;

                        } else {
                            $isOk = false;
                            $stringBuilder .= "a";

                        }

                    break;

                    case 1:

                        $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX() - 1, $this->points[$i-1]->getValueY(), $this->points[$i-1]->getValueZ());

                        if($this->points[$i-1]->isWay1() && $isAvailable){
                            array_push($this->points, Helpers::generateSquarePoint(1, $this->hpSecuence[$i], $this->points[$i-1]));
                            $isOk = true;

                        } else {
                            $isOk = false;
                            $stringBuilder .= "b";

                        }

                    break;

                    case 2:

                        $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX(), $this->points[$i-1]->getValueY() + 1, $this->points[$i-1]->getValueZ());

                        if($this->points[$i-1]->isWay2() && $isAvailable) {
                            array_push($this->points, Helpers::generateSquarePoint(2, $this->hpSecuence[$i], $this->points[$i-1]));
                            $isOk = true;

                        } else {
                            $isOk = false;
                            $stringBuilder .= "c";

                        }

                    break;

                    case 3:

                        $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX(), $this->points[$i-1]->getValueY() - 1, $this->points[$i-1]->getValueZ());

                        if($this->points[$i-1]->isWay3() && $isAvailable) {
                            array_push($this->points, Helpers::generateSquarePoint(3, $this->hpSecuence[$i], $this->points[$i-1]));
                            $isOk = true;

                        } else {
                            $isOk = false;
                            $stringBuilder .= "d";

                        }

                    break;

                    default:
                        echo "Default case";
                    break;

                }
                
                // Para indicar que en este paso hay un callejon sin salida
                $indexOfA = Helpers::indexOfString($stringBuilder, "a");
                $indexOfB = Helpers::indexOfString($stringBuilder, "b");
                $indexOfC = Helpers::indexOfString($stringBuilder, "c");
                $indexOfD = Helpers::indexOfString($stringBuilder, "d");

                if($indexOfA != -1 && $indexOfB != -1 && $indexOfC != -1 && $indexOfD != -1) {

                    switch($this->points[--$i]->getMovVectorValue()) {

                        case 0:
                            $this->points[$i-1]->setWay0(false);
                        break;

                        case 1:
                            $this->points[$i-1]->setWay1(false);
                        break;

                        case 2:
                            $this->points[$i-1]->setWay2(false);
                        break;

                        case 3:
                            $this->points[$i-1]->setWay3(false);
                        break;

                        default:
                            echo "Default case";
                        break;

                    }

                    array_push($childPoints_C, $this->points[$i]);                    
                    unset($this->points[$i]);
                    $this->points = array_values($this->points);
                    $stringBuilder = "";

                }

            } while ( !$isOk);

            return $i;

        }
        
    }
}
