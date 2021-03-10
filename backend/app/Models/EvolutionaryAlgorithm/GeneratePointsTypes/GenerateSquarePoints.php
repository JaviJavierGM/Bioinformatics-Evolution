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

    public function generateSquarePoint($movVectorValue, $letter, $previousPoint) {        
        $point;
        switch ($movVectorValue) {
            case 0:
                echo "generateSquarePoint - Case 0 <br>";
                $point = new Point($previousPoint->getValueX()+1, $previousPoint->getValueY(), 0, $letter, 0);
                $point->setMovVectorValue($movVectorValue);
                $point->setWay1(false);
                break;

            case 1:
                echo "generateSquarePoint - Case 1 <br>";
                $point = new Point($previousPoint->getValueX()-1, $previousPoint->getValueY(), 0, $letter, 1);
                $point->setMovVectorValue($movVectorValue);
                $point->setWay0(false);
                break;

            case 2:
                echo "generateSquarePoint - Case 2 <br>";
                $point = new Point($previousPoint->getValueX(), $previousPoint->getValueY()+1, 0, $letter, 2);
                $point->setWay3(false);
                break;

            case 3:
                echo "generateSquarePoint - Case 3 <br>";
                $point = new Point($previousPoint->getValueX(), $previousPoint->getValueY()-1, 0, $letter, 3);
                $point->setWay2(false);
                break;

            default:
                echo "generateSquarePoint - Default case";
                break;
        }

        return $point;                
    }

    public function doPoints($childPoints_C, $i) {
        echo 'Metodo doPoints Square <br>';
        
        $isOk = true;
        $stringBuilder = "";
        $widthMatrix;
        $heightMatrix;
        $pointsMatrix;

        if ($this->typeSpace == "correlated") { // 2D Cuadrada sobre un espacio correlacionado
            echo "Space CORRELATED! <br>";

            $widthMatrix = sizeof($this->correlatedMatrix);
            $heightMatrix = sizeof($this->correlatedMatrix[0]);
            $pointsMatrix = $this->correlatedMatrix;
            echo "widthMatrix = ".$widthMatrix."<br>";
            echo "heightMatrix = ".$heightMatrix."<br>";

            do {
                switch (rand( 0, 3)) { 
                    
                    case 0: // Derecha
                        echo "doPoints - Case 0 - Derecha <br>";

                        if ( ((int)$this->points[$i-1]->getValueX()) < ($widthMatrix-1) ) {                        
                            $valueMatrix = $pointsMatrix[(int)$this->points[$i-1]->getValueX() + 1][(int)$this->points[$i-1]->getValueY()];                                                                                                                                                                
                            
                            if(strcmp($valueMatrix, "1") == 0) {
                                $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX()+1, $this->points[$i-1]->getValueY(), $this->points[$i-1]->getValueZ());;                                
                                                                                                        
                                if( $this->points[$i-1]->isWay0() && $isAvailable) {
                                    array_push($this->points, $this->generateSquarePoint(0, $this->hpSecuence[$i], $this->points[$i-1]));
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
                        echo "doPoints - Case 1 - Izquierda <br>";

                        if( ( (int)($this->points[$i-1]->getValueX()) ) > 0 ) {
                            $valueMatrix = $pointsMatrix[ ((int)($this->points[$i-1]->getValueX())) - 1 ][ (int)($this->points[$i-1]->getValueY()) ];

                            if(strcmp($valueMatrix, "1") == 0) {
                                $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX()-1, $this->points[$i-1]->getValueY(), $this->points[$i-1]->getValueZ());                                

                                if($this->points[$i-1]->isWay1() && $isAvailable) {
                                    array_push($this->points, $this->generateSquarePoint(1, $this->hpSecuence[$i], $this->points[$i-1]));
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
                        echo "doPoints - Case 2 - Abajo <br>";

                        if( (int)($this->points[$i-1]->getValueY() < ($heightMatrix - 1)) ) {
                            $valueMatrix = $pointsMatrix[ (int)($this->points[$i-1]->getValueX()) ][ ((int)($this->points[$i-1]->getValueY()) + 1) ];                            

                            if(strcmp($valueMatrix, "1") == 0) {
                                $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX(), $this->points[$i-1]->getValueY() + 1, $this->points[$i-1]->getValueZ());

                                if($this->points[$i-1]->isWay2() && $isAvailable) {
                                    array_push($this->points, $this->generateSquarePoint(2, $this->hpSecuence[$i], $this->points[$i-1]));
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
                        echo "doPoints - Case 3 - Arriba <br>";

                        if( (int)($this->points[$i-1]->getValueY()) > 0 ) {
                            $valueMatrix = $pointsMatrix[ (int)($this->points[$i-1]->getValueX()) ][ ((int)($this->points[$i-1]->getValueY() - 1)) ];

                            if(strcmp($valueMatrix, "1") == 0) {
                                $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX(), $this->points[$i-1]->getValueY() - 1, $this->points[$i-1]->getValueZ());
                                
                                if($this->points[$i-1]->isWay3() && $isAvailable) {
                                    array_push($this->points, $this->generateSquarePoint(3, $this->hpSecuence[$i], $this->points[$i-1]));
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

                // var_dump($stringBuilder);
                // var_dump($isOk);
                // var_dump(!$isOk);

                $indexOfA = Helpers::indexOfString($stringBuilder, "a");
                $indexOfB = Helpers::indexOfString($stringBuilder, "b");
                $indexOfC = Helpers::indexOfString($stringBuilder, "c");
                $indexOfD = Helpers::indexOfString($stringBuilder, "d");

                // var_dump($this->points);

                if($indexOfA != -1 && $indexOfB != -1 && $indexOfC != -1 && $indexOfD != -1) {

                    // echo "<br><br> ---------IF INDEX OF i=".$i." --------<br><br>";

                    switch($this->points[--$i]->getMovVectorValue()) {                        
                        case 0:
                            var_dump($i);
                            // die();
                            $this->points[$i-1]->setWay0(false);                            
                            // $this->points[$i]->setWay0(false);
                        break;
                        
                        case 1:
                            var_dump($i);
                            // die();
                            $this->points[$i-1]->setWay1(false);                            
                            // $this->points[$i]->setWay1(false);
                        break;
                        
                        case 2:
                            var_dump($i);
                            // die();
                            $this->points[$i-1]->setWay2(false);
                            // $this->points[$i]->setWay2(false);
                        break;
                        
                        case 3:
                            var_dump($i);
                            // die();
                            $this->points[$i-1]->setWay3(false);                            
                            // $this->points[$i]->setWay3(false);
                        break;
                        
                        default:
                            echo "Default case";
                        break;
                    }

                    // echo "---------------------------- se muere aca";
                    // var_dump($i);
                    // var_dump($this->points);

                    array_push($childPoints_C, $this->points[$i]);                    
                    unset($this->points[$i]);
                    $this->points = array_values($this->points);
                    $stringBuilder = "";

                }

                //echo "fin xd"; die();

            } while ( !$isOk );
            
            return $i;

        } else { // 2D Cuadrada sobre un espacio homogeneo
            echo "homogeneous space! <br>";
            
            do {
                
                switch (rand( 0, 3)) {

                    case 0:
                        echo "doPoints - Case 0 <br>";
                        $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX() + 1, $this->points[$i-1]->getValueY(), $this->points[$i-1]->getValueZ());

                        if($this->points[$i-1]->isWay0() && $isAvailable) {
                            array_push($this->points, $this->generateSquarePoint(0, $this->hpSecuence[$i], $this->points[$i-1]));
                            $isOk = true;

                        } else {
                            $isOk = false;
                            $stringBuilder .= "a";

                        }

                    break;

                    case 1:
                        echo "doPoints - Case 1 <br>";
                        $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX() - 1, $this->points[$i-1]->getValueY(), $this->points[$i-1]->getValueZ());

                        if($this->points[$i-1]->isWay1() && $isAvailable){
                            array_push($this->points, $this->generateSquarePoint(1, $this->hpSecuence[$i], $this->points[$i-1]));
                            $isOk = true;

                        } else {
                            $isOk = false;
                            $stringBuilder .= "b";

                        }

                    break;

                    case 2:
                        echo "doPoints - Case 2 <br>";
                        $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX(), $this->points[$i-1]->getValueY() + 1, $this->points[$i-1]->getValueZ());

                        if($this->points[$i-1]->isWay2() && $isAvailable) {
                            array_push($this->points, $this->generateSquarePoint(2, $this->hpSecuence[$i], $this->points[$i-1]));
                            $isOk = true;

                        } else {
                            $isOk = false;
                            $stringBuilder .= "c";

                        }

                    break;

                    case 3:
                        echo "doPoints - Case 3 <br>";
                        $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX(), $this->points[$i-1]->getValueY() - 1, $this->points[$i-1]->getValueZ());

                        if($this->points[$i-1]->isWay3() && $isAvailable) {
                            array_push($this->points, $this->generateSquarePoint(3, $this->hpSecuence[$i], $this->points[$i-1]));
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
                    echo "<br><br> ---------IF INDEX OF i=".$i." --------<br><br>";
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

            echo "salio del dowhile <br>";
            var_dump($stringBuilder);
            
            return $i;

        }
        
    }
}
