<?php

namespace App\Models\EvolutionaryAlgorithm\GeneratePointsTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\GeneratePoints;
use App\Models\EvolutionaryAlgorithm\Point;
use App\Helpers\Helpers;

class GenerateTrianglePoints extends GeneratePoints
{
    use HasFactory;

    public function generateTrianglePoint($movVectorValue, $letter, $previousPoint) {
        $point;
        switch ($movVectorValue) {

            case 0:               
                $point = new Point($previousPoint->getValueX()+1, $previousPoint->getValueY(), 0, $letter, 0);
                $point->setMovVectorValue($movVectorValue);
                $point->setWay1(false);
            break;

            case 1:
                $point = new Point($previousPoint->getValueX()-1, $previousPoint->getValueY(), 0, $letter, 1);
                $point->setMovVectorValue($movVectorValue);
                $point->setWay0(false);
            break;

            case 2:
                $point = new Point($previousPoint->getValueX()+0.5, $previousPoint->getValueY()+1, 0, $letter, 2);
                $point->setMovVectorValue($movVectorValue);
                $point->setWay5(false);                
            break;

            case 3:
                $point = new Point($previousPoint->getValueX()+0.5, $previousPoint->getValueY()-1, 0, $letter, 3);
                $point->setMovVectorValue($movVectorValue);
                $point->setWay4(false);                
            break;

            case 4:
                $point = new Point($previousPoint->getValueX()-0.5, $previousPoint->getValueY()+1, 0, $letter, 4);
                $point->setMovVectorValue($movVectorValue);
                $point->setWay3(false);
            break;

            case 5:
                $point = new Point($previousPoint->getValueX()-0.5, $previousPoint->getValueY()-1, 0, $letter, 5);
                $point->setMovVectorValue($movVectorValue);
                $point->setWay2(false);
            break;

            default:
                echo "Default case";
            break;

        }
        
        return $point;
    }

    public function doPoints($childPoints_C, $i) {
        
        $isOk = true;
        $stringBuilder = "";        

        do {

            switch (rand( 0, 5)) {                

                case 0:
                    echo "do points case 0 <br>";
                    $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX()+1, $this->points[$i-1]->getValueY(), $this->points[$i-1]->getValueZ());

                    if($this->points[$i-1]->isWay0() && $isAvailable) {
                        array_push($this->points, $this->generateTrianglePoint(0, $this->hpSecuence[$i], $this->points[$i-1]));                        
                        $isOk = true;
                        
                    } else {
                        $isOk = false;
                        $stringBuilder .= "a";

                    }

                break;

                case 1:
                    echo "do points case 1 <br>";
                    $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX()-1, $this->points[$i-1]->getValueY(), $this->points[$i-1]->getValueZ());

                    if($this->points[$i-1]->isWay1() && $isAvailable) {
                        array_push($this->points, $this->generateTrianglePoint(1, $this->hpSecuence[$i], $this->points[$i-1]));
                        $isOk = true;

                    } else {
                        $isOk = false;
                        $stringBuilder .= "b";

                    }

                break;

                case 2:
                    echo "do points case 2 <br>";
                    $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX()+0.5, $this->points[$i-1]->getValueY()+1, $this->points[$i-1]->getValueZ());

                    if($this->points[$i-1]->isWay2() && $isAvailable) {
                        array_push($this->points, $this->generateTrianglePoint(2, $this->hpSecuence[$i], $this->points[$i-1]));
                        $isOk = true;

                    } else {

                        $isOk = false;
                        $stringBuilder .= "c";

                    }

                break;

                case 3:
                    echo "do points case 3 <br>";
                    $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX()+0.5, $this->points[$i-1]->getValueY()-1, $this->points[$i-1]->getValueZ());

                    if($this->points[$i-1]->isWay3() && $isAvailable) {
                        array_push($this->points, $this->generateTrianglePoint(3, $this->hpSecuence[$i], $this->points[$i-1]));
                        $isOk =  true;

                    } else {
                        $isOk = false;
                        $stringBuilder .= "d";

                    }

                break;

                case 4:
                    echo "do points case 4 <br>";
                    $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX()-0.5, $this->points[$i-1]->getValueY()+1, $this->points[$i-1]->getValueZ());

                    if($this->points[$i-1]->isWay4() && $isAvailable) {
                        array_push($this->points, $this->generateTrianglePoint(4, $this->hpSecuence[$i], $this->points[$i-1]));
                        $isOk = true;

                    } else {
                        $isOk = false;
                        $stringBuilder .= "e";

                    }

                break;

                case 5:
                    echo "do points case 5 <br>";
                    $isAvailable = Helpers::isAvailable($this->points, $childPoints_C, $this->points[$i-1]->getValueX()-0.5, $this->points[$i-1]->getValueY()-1, $this->points[$i-1]->getValueZ());
                    
                    if($this->points[$i-1]->isWay5() && $isAvailable){
                        array_push($this->points, $this->generateTrianglePoint(5, $this->hpSecuence[$i], $this->points[$i-1]));
                        $isOk = true;                        
                        
                    } else {
                        $isOk = false;
                        $stringBuilder .= "f";

                    }
                    

                break;

            }

            $indexOfA = Helpers::indexOfString($stringBuilder, "a");
            $indexOfB = Helpers::indexOfString($stringBuilder, "b");
            $indexOfC = Helpers::indexOfString($stringBuilder, "c");
            $indexOfD = Helpers::indexOfString($stringBuilder, "d");
            $indexOfE = Helpers::indexOfString($stringBuilder, "e");
            $indexOfF = Helpers::indexOfString($stringBuilder, "f");

            if($indexOfA != -1 && $indexOfB != -1 && $indexOfC != -1 && $indexOfD != -1 && $indexOfE != -1 && $indexOfF != -1) {
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

                    case 4:
                        $this->points[$i-1]->setWay4(false);
                    break;

                    case 5:
                        $this->points[$i-1]->setWay5(false);
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

        } while (!$isOk);

        return $i;

    }
}
