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

}