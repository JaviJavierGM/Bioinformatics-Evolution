<?php
namespace App\Helpers;

use App\Models\EvolutionaryAlgorithm\Point;

class Helpers {

    public function __construct() {

    }

    public static function indexOf($haystack, $needle) {
        // Encuentra la posición numérica de la primera 
        // ocurrencia del needle (aguja) en el array haystack (pajar). 
        $flag = true;
        $sizeHaystack = sizeof($haystack);
        $i = 0;
        $position = -1;

        while($flag and $i < $sizeHaystack) {
            if($haystack[$i] == $needle) {
                $position = $i;
                $flag = false;
            }else {
                $i++;
            }
        }

        return $position;
    }

    public static function lastIndexOf($haystack, $needle) {
        // Encuentra la posición numérica de la ultima 
        // ocurrencia del needle (aguja) en el array haystack (pajar). 
        $flag = true;
        $i = sizeof($haystack)-1;
        $position = -1;

        while($flag and $i >= 0) {
            if($haystack[$i] == $needle) {
                $position = $i;
                $flag = false;
            }else {
                $i--;
            }
        }

        return $position;
    }

    public static function indexOfString($haystack, $needle) {
        // Encuentra la posición numérica de la primera 
        // ocurrencia del needle (aguja) en el string haystack (pajar). 
        $flag = true;
        $sizeHaystack = strlen($haystack);
        $i = 0;
        $position = -1;

        while($flag and $i < $sizeHaystack) {
            if($haystack[$i] == $needle) {
                $position = $i;
                $flag = false;
            }else {
                $i++;
            }
        }

        return $position;
    }

    public static function isH($points, $xValue, $yValue, $zValue) {
        $isHidro = false;

        foreach ($points as $point) {
            if((Helpers::compare($point->getValueX(), $xValue) == 0) && (Helpers::compare($point->getValueY(), $yValue) == 0) && (Helpers::compare($point->getValueZ(), $zValue) == 0) && ($point->getLetter() == 'H')) {
                $isHidro = true;
                break;
            }
        }
        return $isHidro;
    }

    public static function isP($points, $xValue, $yValue, $zValue) {
        $isPolar = false;

        foreach ($points as $point) {
            if((Helpers::compare($point->getValueX(), $xValue) == 0) && (Helpers::compare($point->getValueY(), $yValue) == 0) && (Helpers::compare($point->getValueZ(), $zValue) == 0) && ($point->getLetter() == 'P')) {
                $isPolar = true;
                break;
            }
        }
        return $isPolar;
    }

    public static function compare($firstValue, $secondValue) {
        if($firstValue == $secondValue) {
            return 0;
        } elseif ($firstValue < $secondValue) {
            return -1;
        } else {
            return 1;
        }
    }

    public static function isAvailable($points, $pointsC, $x, $y, $z) {
        foreach($points as $point) {
            $compareX = Helpers::compare($point->getValueX(), $x);
            $compareY = Helpers::compare($point->getValueY(), $y);
            $compareZ = Helpers::compare($point->getValueZ(), $z);
            if($compareX == 0 && $compareY == 0 && $compareZ == 0){
                return false;
            }
        }
        foreach($pointsC as $point) {
            $compareX = Helpers::compare($point->getValueX(), $x);
            $compareY = Helpers::compare($point->getValueY(), $y);
            $compareZ = Helpers::compare($point->getValueZ(), $z);
            if($compareX == 0 && $compareY == 0 && $compareZ ==0){
                return false;
            }
        } 
        return true;
    }

    public static function generateSquarePoint($movVectorValue, $letter, $previousPoint) {        
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

                $point = new Point($previousPoint->getValueX(), $previousPoint->getValueY()+1, 0, $letter, 2);
                $point->setWay3(false);
                break;

            case 3:

                $point = new Point($previousPoint->getValueX(), $previousPoint->getValueY()-1, 0, $letter, 3);
                $point->setWay2(false);
                break;

            default:
                echo "Helpers - generateSquarePoint - Default case";
                break;
        }

        return $point;                
    }

}