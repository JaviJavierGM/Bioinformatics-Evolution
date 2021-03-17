<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helpers;

abstract class CrossoverOperator extends Model
{
    use HasFactory;

    public $parent_one;
    public $parent_two;
    public $children_one;
    public $children_two;
    public $crossover_probability;

    public $typeSpace;
    public $correlatedMatrix;
    public $generation;
    public $hpSecuence;

    abstract public static function execute(
        $lengthHpString, $spaceType,
        $pointsChildrenCopy,
        $pointsParentOne,
        $pointsParentTwo,
        $newChildrenOne,
        $newChildrenTwo
    );

    public function getChildrenOne() {
        return $this->children_one;
    }

    public function getChildrenTwo() {
        return $this->children_two;
    }

    public function make_seed() {
    list($usec, $sec) = explode(' ', microtime());
    return (float) $sec + ((float) $usec * 100000);
    }

    public function decimalRandom() {
        return rand(0, 1000000) / 1000000;
    }

    public function printArray($array) {
        echo '[ ';
        for($i = 0; $i < sizeof($array); $i++) {
            echo $array[$i].', ';
        }
        echo ' ]'.'<br/>';
    }

    public function checkSquareChildren($childPoints_C, $movVectorValue, $pointsChildren, $j) {
        
        /* 
        int spaceType = main.getBoard().getSpaceType();
        String[][] puntos = null; ----- $this->correlatedMatrix
        */
        $isOk = true;
        $stringBuilder = "";
        $widthMatrix;
        $heightMatrix;

        if($this->typeSpace == 'correlated') {            

            $widthMatrix = sizeof($this->correlatedMatrix);
            $heightMatrix = sizeof($this->correlatedMatrix[0]);
            
            do{
                $point = Helpers::generateSquarePoint($movVectorValue, $this->hpSecuence[$j], $pointsChildren[$j-1]);

                switch ($movVectorValue) {
                    
                    case 0:

                        if( ((int)$pointsChildren[$j-1]->getValueX()) < ($widthMatrix - 1) ) {                        
                            $valueMatrix = $this->correlatedMatrix[(int)$pointsChildren[$j - 1]->getValueX() + 1][(int)$pointsChildren[$j-1]->getValueY()];
                            
                            if(strcmp($valueMatrix, "1") == 0) {                                
                                $isAvailable = Helpers::isAvailable($pointsChildren, $childPoints_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());

                                if($pointsChildren[$j-1]->isWay0() && $isAvailable) {                                    
                                    array_push($pointsChildren, $point);
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
                    
                    case 1:

                        if( (int)$pointsChildren[$j-1]->getValueX() > 0 ) {
                            $valueMatrix = $this->correlatedMatrix[((int)($pointsChildren[$j-1]->getValueX())) - 1][((int)($pointsChildren[$j-1]->getValueY()))];

                            if(strcmp($valueMatrix, "1") == 0) {
                                $isAvailable = Helpers::isAvailable($pointsChildren, $childPoints_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());

                                if($pointsChildren[$j-1]->isWay1() && $isAvailable) {
                                    array_push($pointsChildren, $point);
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
                    
                    case 2:

                        if( ((int)($pointsChildren[$j-1]->getValueY()) < ($heightMatrix - 1) ) ) {                            
                            $valueMatrix = $this->correlatedMatrix[(int)$pointsChildren[$j-1]->getValueX()][(int)$pointsChildren[$j-1]->getValueY() + 1];

                            if(strcmp($valueMatrix, "1") == 0) {                                
                                $isAvailable = Helpers::isAvailable($pointsChildren, $childPoints_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());

                                if($pointsChildren[$j-1]->isWay2() && $isAvailable) {                                    
                                    array_push($pointsChildren, $point);
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
                    
                    case 3:

                        if( (int)($pointsChildren[$j-1]->getValueY()) > 0 ) {
                            $valueMatrix = $this->correlatedMatrix[(int)($pointsChildren[$j-1]->getValueX())][(int)($pointsChildren[$j-1]->getValueY() - 1)];

                            if(strcmp($valueMatrix, "1") == 0) {
                                $isAvailable = Helpers::isAvailable($pointsChildren, $childPoints_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());

                                if($pointsChildren[$j-1]->isWay3() && $isAvailable) {
                                    array_push($pointsChildren, $point);
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
                        echo "Default case";
                    break;
                }

                if( !$isOk ) {
                    $movVectorValue = rand( 0, 3);
                }

                $indexOfA = Helpers::indexOfString($stringBuilder, "a");
                $indexOfB = Helpers::indexOfString($stringBuilder, "b");
                $indexOfC = Helpers::indexOfString($stringBuilder, "c");
                $indexOfD = Helpers::indexOfString($stringBuilder, "d");

                if($indexOfA != -1 && $indexOfB != -1 && $indexOfC != -1 && $indexOfD != -1) {
                    
                    switch($pointsChildren[--$j]->getMovVectorValue()) {
                        case 0:
                            $pointsChildren[$j-1]->setWay0(false);                            
                        break;
                        
                        case 1:
                            $pointsChildren[$j-1]->setWay1(false);                            
                        break;
                        
                        case 2:
                            $pointsChildren[$j-1]->setWay2(false);
                        break;
                        
                        case 3:
                            $pointsChildren[$j-1]->setWay3(false);                            
                        break;
                        
                        default:
                            echo "Default case";
                        break;
                    }

                    array_push($childPoints_C, $pointsChildren[$j]);
                    unset($pointsChildren[$j]);
                    $pointsChildren = array_values($pointsChildren);
                    $stringBuilder = "";

                }

            } while ( !$isOk );
            
            return $j;

        } else {
            echo "case homogeneo";

            do {
                $point = Helpers::generateSquarePoint($movVectorValue, $this->hpSecuence[$j], $pointsChildren[$j-1]);

                switch ($movVectorValue) {
                    
                    case 0:

                        $isAvailable = Helpers::isAvailable($pointsChildren, $childPoints_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());
                        
                        if($pointsChildren[$j-1]->isWay0() && $isAvailable) {
                            array_push($pointsChildren, $point);
                            $isOk = true;

                        } else {
                            $isOk = false;
                            $stringBuilder .= "a";

                        }

                    break;


                    case 1:

                        $isAvailable = Helpers::isAvailable($pointsChildren, $childPoints_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());
                        
                        if($pointsChildren[$j-1]->isWay1() && $isAvailable) {
                            array_push($pointsChildren, $point);
                            $isOk = true;

                        } else {
                            $isOk = false;
                            $stringBuilder .= "b";

                        }

                    break;


                    case 2:

                        $isAvailable = Helpers::isAvailable($pointsChildren, $childPoints_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());
                        
                        if($pointsChildren[$j-1]->isWay2() && $isAvailable) {
                            array_push($pointsChildren, $point);
                            $isOk = true;

                        } else {
                            $isOk = false;
                            $stringBuilder .= "c";

                        }                        

                    break;


                    case 3:
                        
                        $isAvailable = Helpers::isAvailable($pointsChildren, $childPoints_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());
                        
                        if($pointsChildren[$j-1]->isWay3() && $isAvailable) {
                            array_push($pointsChildren, $point);
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

                if(!$isOk) {
                    $movVectorValue = rand( 0, 3);
                }

                $indexOfA = Helpers::indexOfString($stringBuilder, "a");
                $indexOfB = Helpers::indexOfString($stringBuilder, "b");
                $indexOfC = Helpers::indexOfString($stringBuilder, "c");
                $indexOfD = Helpers::indexOfString($stringBuilder, "d");

                if($indexOfA != -1 && $indexOfB != -1 && $indexOfC != -1 && $indexOfD != -1) {                    
                    
                    switch($pointsChildren[--$j]->getMovVectorValue()) {
                        case 0:
                            $pointsChildren[$j-1]->setWay0(false);                            
                        break;
                        
                        case 1:
                            $pointsChildren[$j-1]->setWay1(false);                            
                        break;
                        
                        case 2:
                            $pointsChildren[$j-1]->setWay2(false);
                        break;
                        
                        case 3:
                            $pointsChildren[$j-1]->setWay3(false);                            
                        break;
                        
                        default:
                            echo "Default case";
                        break;
                    }

                    array_push($childPoints_C, $pointsChildren[$j]);
                    unset($pointsChildren[$j]);
                    $pointsChildren = array_values($pointsChildren);
                    $stringBuilder = "";

                }

            } while (!$isOk);

            return $j;

        }
    }

}
