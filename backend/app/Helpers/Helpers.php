<?php
namespace App\Helpers;

class Helpers {

    public function __construct() {

    }

    public function indexOf($haystack, $needle) {
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

    public function lastIndexOf($haystack, $needle) {
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

}