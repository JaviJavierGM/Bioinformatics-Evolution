<?php

namespace App\Models\EvolutionaryAlgorithm\CrossoverTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\CrossoverOperator;
use App\Models\EvolutionaryAlgorithm\Point;

class Uniform extends CrossoverOperator
{
    use HasFactory;

    public function execute($pointsParentOne, $pointsParentTwo, $newChildrenOne, $newChildrenTwo, $pointsChildren_C) {
        // Generacion de los puntos de corte.
        $cuts = array();
        
        if($this->crossoverProbability > $this->decimalRandom()) {
            for ($i=0; $i < $this->lengthHpString; $i++) { 
                array_push($cuts, rand(0, 1));
            }
        } else {
            for ($i=0; $i < $this->lengthHpString; $i++) { 
                array_push($cuts, 0);
            }
        }

        // Generación del primer hijo
        for ($j=1; $j < $this->lengthHpString; $j++) {
            // echo 'Entro a la iteración '.$j.'<br>';
            if($cuts[$j] == 0) {
                if($this->typeDimension == '2D_Square') {
                    $j = $this->checkSquareChildren($pointsChildren_C, $pointsParentOne[$j]->getMovVectorValue(), $newChildrenOne, $j);
                } elseif($this->typeDimension == '2D_Triangle') {
                    $j = $this->checkTriangleChildren($pointsChildren_C, $pointsParentOne[$j]->getMovVectorValue(), $newChildrenOne, $j);
                } elseif($this->typeDimension == '3D_Cubic') {
                    $j = $this->checkCubeChildren($pointsChildren_C, $pointsParentOne[$j]->getMovVectorValue(), $newChildrenOne, $j);
                }
            } else {
                if($this->typeDimension == '2D_Square') {
                    $j = $this->checkSquareChildren($pointsChildren_C, $pointsParentTwo[$j]->getMovVectorValue(), $newChildrenOne, $j);
                } elseif($this->typeDimension == '2D_Triangle') {
                    $j = $this->checkTriangleChildren($pointsChildren_C, $pointsParentTwo[$j]->getMovVectorValue(), $newChildrenOne, $j);
                } elseif($this->typeDimension == '3D_Cubic') {
                    $j = $this->checkCubeChildren($pointsChildren_C, $pointsParentTwo[$j]->getMovVectorValue(), $newChildrenOne, $j);
                }
            }
        }

        $pointsChildren_C = array();

        // Generación del primer punto del hijo #2.
        if($this->typeSpace == 'correlated') {
            array_push($newChildrenTwo, new Point($this->origenX, $this->origenY, 0, $pointsParentTwo[0]->getLetter(), 0));
        } else {
            array_push($newChildrenTwo, new Point(0, 0, 0, $pointsParentTwo[0]->getLetter(), 0));
        }

        // Generación del segundo hijo
        for ($j=1; $j < $this->lengthHpString; $j++) { 
            if($cuts[$j] == 0) {
                if($this->typeDimension == '2D_Square') {
                    $j = $this->checkSquareChildren($pointsChildren_C, $pointsParentTwo[$j]->getMovVectorValue(), $newChildrenTwo, $j);
                } elseif($this->typeDimension == '2D_Triangle') {
                    $j = $this->checkTriangleChildren($pointsChildren_C, $pointsParentTwo[$j]->getMovVectorValue(), $newChildrenTwo, $j);
                } elseif($this->typeDimension == '3D_Cubic') {
                    $j = $this->checkCubeChildren($pointsChildren_C, $pointsParentTwo[$j]->getMovVectorValue(), $newChildrenTwo, $j);
                }
            } else {
                if($this->typeDimension == '2D_Square') {
                    $j = $this->checkSquareChildren($pointsChildren_C, $pointsParentOne[$j]->getMovVectorValue(), $newChildrenTwo, $j);
                } elseif($this->typeDimension == '2D_Triangle') {
                    $j = $this->checkTriangleChildren($pointsChildren_C, $pointsParentOne[$j]->getMovVectorValue(), $newChildrenTwo, $j);
                } elseif($this->typeDimension == '3D_Cubic') {
                    $j = $this->checkCubeChildren($pointsChildren_C, $pointsParentOne[$j]->getMovVectorValue(), $newChildrenTwo, $j);
                }
            }
        }

        $childrens = array (
            'one' => $newChildrenOne,
            'two' => $newChildrenOne
        );

        return $childrens;
    }
}
