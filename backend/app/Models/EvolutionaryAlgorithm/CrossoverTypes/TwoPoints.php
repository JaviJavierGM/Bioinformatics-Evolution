<?php

namespace App\Models\EvolutionaryAlgorithm\CrossoverTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\CrossoverOperator;

class TwoPoints extends CrossoverOperator
{
    use HasFactory;

    public function execute($pointsParentOne, $pointsParentTwo, $newChildrenOne, $newChildrenTwo, $pointsChildren_C) {
        // Generacion de los 2 puntos de corte de acuerdo a la probabilidad de cruze dada.
        if($this->crossoverProbability > $this->decimalRandom()) {
            $cutOne = rand(0, ($this->lengthHpString/2)-1);
            $cutTwo = rand(0, ($this->lengthHpString/2)-1) + (round($this->lengthHpString/2, null, PHP_ROUND_HALF_DOWN));
        } else {
            $cutOne = $this->lengthHpString;
            $cutTwo = $this->lengthHpString;
        }
        
        // Generación del primer hijo.
        for($j=1; $j < $this->lengthHpString; $j++) {
            if($j < $cutOne) {
                if($this->typeDimension == '2D_Square') {
                    $j = $this->checkSquareChildren($pointsChildren_C, $pointsParentOne[$j]->getMovVectorValue(), $newChildrenOne, $j);
                } elseif($this->typeDimension == '2D_Triangle') {
                    $j = $this->checkTriangleChildren($pointsChildren_C, $pointsParentOne[$j]->getMovVectorValue(), $newChildrenOne, $j);
                } elseif($this->typeDimension == '3D_Cubic') {

                }
            } elseif($j < $cutTwo) {
                if($this->typeDimension == '2D_Square') {
                    $j = $this->checkSquareChildren($pointsChildren_C, $pointsParentTwo[$j]->getMovVectorValue(), $newChildrenOne, $j);
                } elseif($this->typeDimension == '2D_Triangle') {
                    $j = $this->checkTriangleChildren($pointsChildren_C, $pointsParentTwo[$j]->getMovVectorValue(), $newChildrenOne, $j);
                } elseif($this->typeDimension == '3D_Cubic') {

                }
            } else {
                if($this->typeDimension == '2D_Square') {
                    $j = $this->checkSquareChildren($pointsChildren_C, $pointsParentOne[$j]->getMovVectorValue(), $newChildrenOne, $j);
                } elseif($this->typeDimension == '2D_Triangle') {
                    $j = $this->checkTriangleChildren($pointsChildren_C, $pointsParentOne[$j]->getMovVectorValue(), $newChildrenOne, $j);
                } elseif($this->typeDimension == '3D_Cubic') {

                }
            }
        }

        $pointsChildren_C = array();

        // Generación del primer punto del hijo #2.
        if($this->typeSpace == 'correlated') {
            array_push($newChildrenTwo, new Point($origenX = 0, $origenY = 0, 0, $pointsParentTwo[0]->getLetter(), 0));
        } else {
            array_push($newChildrenTwo, new Point(0, 0, 0, $pointsParentTwo[0]->getLetter(), 0));
        }

        // Generación del segundo hijo.
        for($j=1; $j < $this->lengthHpString; $j++) { 
            if($j < $cutOne) {
                if($this->typeDimension == '2D_Square') {
                    $j = $this->checkSquareChildren($pointsChildren_C, $pointsParentTwo[$j]->getMovVectorValue(), $newChildrenTwo, $j);
                } elseif($this->typeDimension == '2D_Triangle') {
                    $j = $this->checkTriangleChildren($pointsChildren_C, $pointsParentTwo[$j]->getMovVectorValue(), $newChildrenTwo, $j);
                } elseif($this->typeDimension == '3D_Cubic') {

                }
            } elseif($j < $cutTwo) {
                if($this->typeDimension == '2D_Square') {
                    $j = $this->checkSquareChildren($pointsChildren_C, $pointsParentOne[$j]->getMovVectorValue(), $newChildrenTwo, $j);
                } elseif($this->typeDimension == '2D_Triangle') {
                    $j = $this->checkTriangleChildren($pointsChildren_C, $pointsParentOne[$j]->getMovVectorValue(), $newChildrenTwo, $j);
                } elseif($this->typeDimension == '3D_Cubic') {

                }
            } else {
                if($this->typeDimension == '2D_Square') {
                    $j = $this->checkSquareChildren($pointsChildren_C, $pointsParentTwo[$j]->getMovVectorValue(), $newChildrenTwo, $j);
                } elseif($this->typeDimension == '2D_Triangle') {
                    $j = $this->checkTriangleChildren($pointsChildren_C, $pointsParentTwo[$j]->getMovVectorValue(), $newChildrenTwo, $j);
                } elseif($this->typeDimension == '3D_Cubic') {

                }
            }
        }

        $childrens = array (
            'one' => $newChildrenOne,
            'two' => $newChildrenOne
        );

        return $childrens;
    }

    public function execute23($lengthHpString) {
        echo 'Parent one: ';
        $this->printArray($this->parent_one);
        
        echo 'Parent two: ';
        $this->printArray($this->parent_two);

        // Generar el punto de corte 
        if($this->crossover_probability > $this->decimalRandom()) {
            $this->cut_one = rand(0, $lengthHpString/2); 
            $this->cut_two = rand(0, ($lengthHpString/2)-1) + (round($lengthHpString/2, null, PHP_ROUND_HALF_DOWN));
            
            //$this->cut_one = 2;
            //$this->cut_two = 7;

            echo '<br/>La seccion de corte_one es: '.$this->cut_one.'<br/>';
            echo 'La seccion de corte_two es: '.$this->cut_two.'<br/><br/>';

            // Generar los dos nuevos hijos.
            for($i=0; $i < $this->cut_one; $i++) { 
                $this->children_one[$i] = $this->parent_one[$i];
                $this->children_two[$i] = $this->parent_two[$i];
            }

            for ($i=$this->cut_one; $i <= $this->cut_two ; $i++) { 
                $this->children_one[$i] = $this->parent_two[$i];
                $this->children_two[$i] = $this->parent_one[$i];
            }

            for($i=$this->cut_two + 1; $i <sizeof($this->parent_two); $i++) {
                $this->children_one[$i] = $this->parent_one[$i];
                $this->children_two[$i] = $this->parent_two[$i];
            }
        } else { // Los dos padres, pasan  a ser los dos nuevos hijos.
            $this->children_one = $this->parent_one;
            $this->children_two = $this->parent_two;
        }

        echo 'Children one: ';
        $this->printArray($this->children_one);
        
        echo 'Children two: ';
        $this->printArray($this->children_two);
    }
}
