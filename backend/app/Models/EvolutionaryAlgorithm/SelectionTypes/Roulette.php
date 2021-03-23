<?php

namespace App\Models\EvolutionaryAlgorithm\SelectionTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\SelectionOperator;
use App\Helpers\Helpers;

class Roulette extends SelectionOperator
{
    use HasFactory;

    public function __construct($generation) {
        $this->generation = $generation;
    }

    public function execute($conformationsToSelectParemeter=null) {
        $sizeGeneration = $this->generation->getSizeGeneration();
        // Numero de conformaciones a seleccionar con la ruleta
        if( !is_null($conformationsToSelectParemeter) ) {
            $conformationsToSelect = $conformationsToSelectParemeter;
        } else {
            $conformationsToSelect = $sizeGeneration;
        }      

        $totalFitness = $this->generation->getTotalFitness() * -1;

        if($totalFitness == 0){
            return false;
        }

        // Ordenar las coformaciones de manera ascendente
        $orderedConformations = $this->generation->getOrderedConformations(true);

        // Calcular el porcentaje de seleccion de cada conformacion de la generacion
        $arrayPercentSelection = array();
        foreach( $orderedConformations as $conformation ) {
            array_push($arrayPercentSelection, ($conformation->getFitness() * -1 / $totalFitness));
        } 

        // Seleccionamos las conformaciones
        $indexSelectedConformations = array();
        while( sizeof($indexSelectedConformations) < $conformationsToSelect ) {
            // Generamos el porcentaje de la ruleta que debemos buscar
            $random = $this->decimalRandom();

            $flag = true;
            $j=0;
            $sumPercentSelection = 0; // Guardara la suma de los porcentajes de las conformaciones

            // Buscamos la conformacion que pertenezca a ese porcentaje de la ruleta
            while( $flag && $j < $sizeGeneration ) {             
                $sumPercentSelection += $arrayPercentSelection[$j];

                if( $sumPercentSelection >= $random ) {
                    // Si el porcentaje de seleccion de la conformacion corresponde con el generado
                    // se guarda esa conformacion en las conformaciones seleccionadas

                    // Verificamos si ya hemos agregado a lo mucho dos veces un mismo indice
                    $returnIndexOf = Helpers::indexOf($indexSelectedConformations, $orderedConformations[$j]->getPositionIndex());
                    $returnLastIndexOf = Helpers::lastIndexOf($indexSelectedConformations, $orderedConformations[$j]->getPositionIndex());


                    if( $returnIndexOf == $returnLastIndexOf ) {
                        array_push($indexSelectedConformations, $orderedConformations[$j]->getPositionIndex());                        
                    }
                    $flag=false;

                } else {
                    // Si no cumple, entonces continuamos buscando con la siguiente conformacion
                    $j++;
                }
            }            
        }

        sort($indexSelectedConformations);
        $this->generation->setIndexSelectedConformations($indexSelectedConformations);

        // Borramos todas las variables creadas
        unset($sizeGeneration, $conformationsToSelect, $totalFitness, $orderedConformations, $arrayPercentSelection, $indexSelectedConformations);
       
        return true;
    }
}
