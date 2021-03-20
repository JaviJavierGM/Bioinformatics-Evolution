<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\MutationTypes\Predefined;
use App\Models\EvolutionaryAlgorithm\MutationTypes\Random;
use App\Models\EvolutionaryAlgorithm\Conformation;
use App\Helpers\Helpers;

abstract class CrossoverOperator extends Model
{
    use HasFactory;

    protected $generation;
    protected $typeSpace;
    protected $typeDimension;
    protected $lengthHpString;
    protected $conformationsNumber;
    protected $crossoverProbability;
    protected $correlatedMatrix;
    protected $hpSecuence;
    protected $mutationType;

    public function __construct(
        $generation,
        $typeSpace,
        $typeDimension,
        $lengthHpString,
        $conformationsNumber,
        $crossoverProbability,
        $correlatedMatrix,
        $hpSecuence,
        $mutationType
    ) {
        $this->generation = $generation;
        $this->typeSpace = $typeSpace;
        $this->typeDimension = $typeDimension;
        $this->lengthHpString = $lengthHpString;
        $this->conformationsNumber = $conformationsNumber;
        $this->crossoverProbability = $crossoverProbability;
        $this->correlatedMatrix = $correlatedMatrix;
        $this->hpSecuence = $hpSecuence;
        $this->mutationType = $mutationType;
        srand($this->make_seed());

        // Generación de una nueva generacion hijos atravez de la generacion padre
        $conformations = array();
        for ($i=0; $i < $this->conformationsNumber; $i++) { 
            $parentOne = 0;
            $parentTwo = 0;
 
            if($this->mutationType == 'predefined') { // Caso del operador genetico mutacion predefinido
                $parents = Predefined::execute($this->generation, $i);
            } else { // Caso del operador genetico mutacion random
                $parents = Random::execute($this->generation, $i);
            }

            $parentOne = $parents['one'];
            $parentTwo = $parents['two'];
            $temporalParent = $parents['temp'];

            $pointsParentOne = $this->generation->getConformations()[$parentOne]->getPoints();
            $pointsParentTwo = $this->generation->getConformations()[$parentTwo]->getPoints();
            $newChildrenOne = array();
            $newChildrenTwo = array();
            for ($m=0; $m < $this->lengthHpString; $m++) { 
                $pointsParentOne[$m]->resetR();
                $pointsParentTwo[$m]->resetR();
            }

            $pointsChildren_C = array();

            // Generación del primer punto del hijo #1.
            if($this->typeSpace == 'correlated') {
                array_push($newChildrenOne, new Point($origenX = 0, $origenY = 0, 0, $pointsParentOne[0]->getLetter(), 0));
            } else {
                array_push($newChildrenOne, new Point(0, 0, 0, $pointsParentOne[0]->getLetter(), 0));
            }

            $childrens = $this->execute($pointsParentOne, $pointsParentTwo, $newChildrenOne, $newChildrenTwo, $pointsChildren_C);
            $newChildrenOne = $childrens['one'];
            $newChildrenTwo = $childrens['two'];

            $childrenOne = new Conformation($newChildrenOne);
            $childrenOne->setParents($temporalParent);
            array_push($conformations, $childrenOne);

            $childrenTwo = new Conformation($newChildrenTwo);
            $childrenTwo->setParents($temporalParent);
            array_push($conformations, $childrenTwo);
        }
    }

    abstract public function execute($pointsParentOne, $pointsParentTwo, $newChildrenOne, $newChildrenTwo, $pointsChildren_C);

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

    public function checkSquareChildren(&$pointsChildren_C, $movVectorValue, &$pointsChildren, $j) {
        
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
                                $isAvailable = Helpers::isAvailable($pointsChildren, $pointsChildren_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());

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
                                $isAvailable = Helpers::isAvailable($pointsChildren, $pointsChildren_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());

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
                                $isAvailable = Helpers::isAvailable($pointsChildren, $pointsChildren_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());

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
                                $isAvailable = Helpers::isAvailable($pointsChildren, $pointsChildren_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());

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

                    array_push($pointsChildren_C, $pointsChildren[$j]);
                    unset($pointsChildren[$j]);
                    $pointsChildren = array_values($pointsChildren);
                    $stringBuilder = "";

                }

            } while ( !$isOk );
            
            return $j;

        } else {
            
            do {
                
                $point = Helpers::generateSquarePoint($movVectorValue, $this->hpSecuence[$j], $pointsChildren[$j-1]);

                switch ($movVectorValue) {
                    
                    case 0:

                        $isAvailable = Helpers::isAvailable($pointsChildren, $pointsChildren_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());
                        
                        if($pointsChildren[$j-1]->isWay0() && $isAvailable) {
                            array_push($pointsChildren, $point);
                            $isOk = true;

                        } else {
                            $isOk = false;
                            $stringBuilder .= "a";

                        }

                    break;


                    case 1:

                        $isAvailable = Helpers::isAvailable($pointsChildren, $pointsChildren_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());
                        
                        if($pointsChildren[$j-1]->isWay1() && $isAvailable) {
                            array_push($pointsChildren, $point);
                            $isOk = true;

                        } else {
                            $isOk = false;
                            $stringBuilder .= "b";

                        }

                    break;


                    case 2:

                        $isAvailable = Helpers::isAvailable($pointsChildren, $pointsChildren_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());
                        
                        if($pointsChildren[$j-1]->isWay2() && $isAvailable) {
                            array_push($pointsChildren, $point);
                            $isOk = true;

                        } else {
                            $isOk = false;
                            $stringBuilder .= "c";

                        }                        

                    break;


                    case 3:
                        
                        $isAvailable = Helpers::isAvailable($pointsChildren, $pointsChildren_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());
                        
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

                    array_push($pointsChildren_C, $pointsChildren[$j]);
                    unset($pointsChildren[$j]);
                    $pointsChildren = array_values($pointsChildren);
                    $stringBuilder = "";

                }

            } while (!$isOk);
            
            return $j;

        }
    }

    public function checkTriangleChildren($pointsChildren_C, $movVectorValue, $pointsChildren, $j) {

        $isOk = true;
        $stringBuilder = "";

        do {
            
            $point = Helpers::generateTrianglePoint($movVectorValue, $this->hpSecuence[$j], $pointsChildren[$j-1]);

            switch ($movVectorValue) {
                
                case 0:
                    
                    $isAvailable = Helpers::isAvailable($pointsChildren, $pointsChildren_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());

                    if($pointsChildren[$j-1]->isWay0() && $isAvailable) {
                        array_push($pointsChildren, $point);
                        $isOk = true;

                    } else {
                        $isOk = false;
                        $stringBuilder .= "a";

                    }

                break;

                case 1:
                    
                    $isAvailable = Helpers::isAvailable($pointsChildren, $pointsChildren_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());

                    if($pointsChildren[$j-1]->isWay1() && $isAvailable) {
                        array_push($pointsChildren, $point);
                        $isOk = true;

                    } else {
                        $isOk = false;
                        $stringBuilder .= "b";

                    }

                break;

                case 2:
                    
                    $isAvailable = Helpers::isAvailable($pointsChildren, $pointsChildren_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());

                    if($pointsChildren[$j-1]->isWay2() && $isAvailable) {
                        array_push($pointsChildren, $point);
                        $isOk = true;

                    } else {
                        $isOk = false;
                        $stringBuilder .= "c";

                    }

                break;

                case 3:
                    
                    $isAvailable = Helpers::isAvailable($pointsChildren, $pointsChildren_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());

                    if($pointsChildren[$j-1]->isWay3() && $isAvailable) {
                        array_push($pointsChildren, $point);
                        $isOk = true;

                    } else {
                        $isOk = false;
                        $stringBuilder .= "d";

                    }

                break;

                case 4:
                    
                    $isAvailable = Helpers::isAvailable($pointsChildren, $pointsChildren_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());

                    if($pointsChildren[$j-1]->isWay4() && $isAvailable) {
                        array_push($pointsChildren, $point);
                        $isOk = true;

                    } else {
                        $isOk = false;
                        $stringBuilder .= "e";

                    }

                break;

                case 5:
                    
                    $isAvailable = Helpers::isAvailable($pointsChildren, $pointsChildren_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());

                    if($pointsChildren[$j-1]->isWay5() && $isAvailable) {
                        array_push($pointsChildren, $point);
                        $isOk = true;

                    } else {
                        $isOk = false;
                        $stringBuilder .= "f";

                    }

                break;
                    
                default:
                    echo "Default Case";
                break;

            }

            if(!$isOk) {
                $movVectorValue = rand(0, 5);
            }

            $indexOfA = Helpers::indexOfString($stringBuilder, "a");
            $indexOfB = Helpers::indexOfString($stringBuilder, "b");
            $indexOfC = Helpers::indexOfString($stringBuilder, "c");
            $indexOfD = Helpers::indexOfString($stringBuilder, "d");
            $indexOfE = Helpers::indexOfString($stringBuilder, "e");
            $indexOfF = Helpers::indexOfString($stringBuilder, "f");

            if($indexOfA != -1 && $indexOfB != -1 && $indexOfC != -1 && $indexOfD != -1 && $indexOfE != -1 && $indexOfF != -1) {
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

                    case 4:
                        $pointsChildren[$j-1]->setWay4(false);
                    break;

                    case 5:
                        $pointsChildren[$j-1]->setWay5(false);
                    break;

                    default:
                        echo "Default case";
                    break;
                }

                array_push($pointsChildren_C, $pointsChildren[$j]);
                unset($pointsChildren[$j]);
                $pointsChildren = array_values($pointsChildren);
                $stringBuilder = "";

            }

        } while (!$isOk);

        return $j;

    }

    public function checkCubeChildren($pointsChildren_C, $movVectorValue, $pointsChildren, $j) {

        $isOk = true;
        $stringBuilder = "";

        do {
            
            switch ($movVectorValue) {
                
                case 0:
                    
                    $isAvailable = Helpers::isAvailable($pointsChildren, $pointsChildren_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());

                    if($pointsChildren[$j-1]->isWay0() && $isAvailable) {
                        array_push($pointsChildren, $point);
                        $isOk = true;

                    } else {
                        $isOk = false;
                        $stringBuilder .= "a";

                    }

                break;

                case 1:
                    
                    $isAvailable = Helpers::isAvailable($pointsChildren, $pointsChildren_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());

                    if($pointsChildren[$j-1]->isWay1() && $isAvailable) {
                        array_push($pointsChildren, $point);
                        $isOk = true;

                    } else {
                        $isOk = false;
                        $stringBuilder .= "b";

                    }
                    
                break;

                case 2:
                    
                    $isAvailable = Helpers::isAvailable($pointsChildren, $pointsChildren_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());

                    if($pointsChildren[$j-1]->isWay2() && $isAvailable) {
                        array_push($pointsChildren, $point);
                        $isOk = true;

                    } else {
                        $isOk = false;
                        $stringBuilder .= "c";

                    }
                    
                break;

                case 3:
                    
                    $isAvailable = Helpers::isAvailable($pointsChildren, $pointsChildren_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());

                    if($pointsChildren[$j-1]->isWay3() && $isAvailable) {
                        array_push($pointsChildren, $point);
                        $isOk = true;

                    } else {
                        $isOk = false;
                        $stringBuilder .= "d";

                    }
                    
                break;

                case 4:
                    
                    $isAvailable = Helpers::isAvailable($pointsChildren, $pointsChildren_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());

                    if($pointsChildren[$j-1]->isWay4() && $isAvailable) {
                        array_push($pointsChildren, $point);
                        $isOk = true;

                    } else {
                        $isOk = false;
                        $stringBuilder .= "e";

                    }
                    
                break;

                case 5:
                    
                    $isAvailable = Helpers::isAvailable($pointsChildren, $pointsChildren_C, $point->getValueX(), $point->getValueY(), $point->getValueZ());

                    if($pointsChildren[$j-1]->isWay5() && $isAvailable) {
                        array_push($pointsChildren, $point);
                        $isOk = true;

                    } else {
                        $isOk = false;
                        $stringBuilder .= "f";

                    }
                    
                break;
                
                default:
                    echo "Default case";
                break;
                
            }

            if(!$isOk) {
                $movVectorValue = rand(0, 5);
            }

            $indexOfA = Helpers::indexOfString($stringBuilder, "a");
            $indexOfB = Helpers::indexOfString($stringBuilder, "b");
            $indexOfC = Helpers::indexOfString($stringBuilder, "c");
            $indexOfD = Helpers::indexOfString($stringBuilder, "d");
            $indexOfE = Helpers::indexOfString($stringBuilder, "e");
            $indexOfF = Helpers::indexOfString($stringBuilder, "f");

            if($indexOfA != -1 && $indexOfB != -1 && $indexOfC != -1 && $indexOfD != -1 && $indexOfE != -1 && $indexOfF != -1) {
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

                    case 4:
                        $pointsChildren[$j-1]->setWay4(false);
                    break;

                    case 5:
                        $pointsChildren[$j-1]->setWay5(false);
                    break;

                    default:
                        echo "Default case";
                    break;
                }

                array_push($pointsChildren_C, $pointsChildren[$j]);
                unset($pointsChildren[$j]);
                $pointsChildren = array_values($pointsChildren);
                $stringBuilder = "";

            }

        } while (!$isOk);

        return $j;

    }

}
