<?php

namespace App\Models\EvolutionaryAlgorithm\CrossoverTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\CrossoverOperator;
use App\Models\EvolutionaryAlgorithm\Point;

class OnePoint extends CrossoverOperator
{
    use HasFactory;

    public function execute($pointsParentOne, $pointsParentTwo, $newChildrenOne, $newChildrenTwo, $pointsChildren_C) {
        // Generacion del punto de corte de acuerdo a la probabilidad de cruze dada.
        if($this->crossoverProbability > $this->decimalRandom()) {
            $cut = rand(1, $this->lengthHpString-1);
        } else {
            $cut = $this->lengthHpString;
        }

        // Generación del primer hijo.
        for ($j=1; $j < $this->lengthHpString; $j++) {
            if($j < $cut) {
                if($this->typeDimension == '2D_Square') {
                    // var_dump($newChildrenOne); die();
                    $j = $this->checkSquareChildren($pointsChildren_C, $pointsParentOne[$j]->getMovVectorValue(), $newChildrenOne, $j);
                } elseif($this->typeDimension == '2D_Triangle') {
                    $j = $this->checkTriangleChildren($pointsChildren_C, $pointsParentOne[$j]->getMovVectorValue(), $newChildrenOne, $j);
                } elseif($this->typeDimension == '3D_Cubic') {

                }
            } else {
                if($this->typeDimension == '2D_Square') {
                    $j = $this->checkSquareChildren($pointsChildren_C, $pointsParentTwo[$j]->getMovVectorValue(), $newChildrenOne, $j);
                } elseif($this->typeDimension == '2D_Triangle') {
                    $j = $this->checkTriangleChildren($pointsChildren_C, $pointsParentTwo[$j]->getMovVectorValue(), $newChildrenOne, $j);
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
        for ($j=1; $j < $this->lengthHpString; $j++) {
            if($j < $cut) {
                if($this->typeDimension == '2D_Square') {
                    $j = $this->checkSquareChildren($pointsChildren_C, $pointsParentTwo[$j]->getMovVectorValue(), $newChildrenTwo, $j);
                } elseif($this->typeDimension == '2D_Triangle') {
                    $j = $this->checkTriangleChildren($pointsChildren_C, $pointsParentTwo[$j]->getMovVectorValue(), $newChildrenTwo, $j);
                } elseif($this->typeDimension == '3D_Cubic') {

                }
            } else {
                if($this->typeDimension == '2D_Square') {
                    $j = $this->checkSquareChildren($pointsChildren_C, $pointsParentOne[$j]->getMovVectorValue(), $newChildrenTwo, $j);
                } elseif($this->typeDimension == '2D_Triangle') {
                    $j = $this->checkTriangleChildren($pointsChildren_C, $pointsParentOne[$j]->getMovVectorValue(), $newChildrenTwo, $j);
                } elseif($this->typeDimension == '3D_Cubic') {

                }
            }
        }

        $childrens = array(
            'one' => $newChildrenOne,
            'two' => $newChildrenTwo
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
            $this->cut = rand(0, $lengthHpString-1); 
            $this->cut += 1;

            echo '<br/>La seccion de corte es: '.$this->cut.'<br/><br/>';

            // Generar los dos nuevos hijos tomando como referencia el punto de corte.
            for($i=0; $i < $this->cut; $i++) { 
                $this->children_one[$i] = $this->parent_one[$i];
                $this->children_two[$i] = $this->parent_two[$i];
            }

            for($i=$this->cut; $i < sizeof($this->parent_two); $i++) {
                $this->children_one[$i] = $this->parent_two[$i];
                $this->children_two[$i] = $this->parent_one[$i];
            }
        } else {
            echo '<br/>La probabilidad de cruce NO es mayor al real random!<br/><br/>';
            $this->children_one = $this->parent_one;
            $this->children_two = $this->parent_two;
        }

        echo 'Children one: ';
        $this->printArray($this->children_one);
        
        echo 'Children two: ';
        $this->printArray($this->children_two);
    }
}
