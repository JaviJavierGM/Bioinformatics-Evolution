<?php

namespace App\Models\EvolutionaryAlgorithm\SelectionTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\SelectionOperator;
use App\Helpers\Helpers;

class TopPercent extends SelectionOperator
{
    use HasFactory;

    private $percent;

    public function __construct($generation, $percent){
        $this->generation = $generation;
        $this->percent = $percent;
    }

    public function execute($conformationsToSelectParemeter=null){
        $sizeGeneration = $this->generation->getSizeGeneration();
        // Numero de conformaciones a seleccionar con el torneo
        if(!is_null($conformationsToSelectParemeter)){
            $conformationsToSelect = $conformationsToSelectParemeter;
        }else{
            $conformationsToSelect = $sizeGeneration;
        }

        $k = round( (($this->percent / 100) * $sizeGeneration), null, PHP_ROUND_HALF_DOWN); // k mejores coformaciones a seleccionar

        // conformaciones de la generacion, ordenadas de forma descendente
        $sublist_L = $this->generation->getOrderedConformations(false);

        // sublista S con los mejores k conformaciones segun su fitness
        $sublist_S = array();

        // Seleccionamos las conformaciones necesarias para el cruce eligiendo de forma 
        // aleatoria un elemento de la sublista s y la agregamos a las conformaciones seleccionadas
        $indexSelectedConformations = array();
        while(sizeof($indexSelectedConformations) < $conformationsToSelect){
            
            if(sizeof($sublist_L) > $k) {
                for($i=0; $i < $k; $i++) {
                    $sublist_S[$i] = $sublist_L[$i];                    
                }
            } else {
                for($i=0; $i < sizeof($sublist_L); $i++){
                    $sublist_S[$i] = $sublist_L[$i]; 
                }
            }
            
            $posRandom = rand(0, sizeof($sublist_S)-1);
            
            $returnIndexOf = Helpers::indexOf($indexSelectedConformations, $sublist_S[$posRandom]->getPositionIndex());
            $returnLastIndexOf = Helpers::lastIndexOf($indexSelectedConformations, $sublist_S[$posRandom]->getPositionIndex());

            if( $returnIndexOf == $returnLastIndexOf ) {
                array_push($indexSelectedConformations, $sublist_S[$posRandom]->getPositionIndex());
            }else{
                unset($sublist_L[$posRandom]);
                $sublist_L = array_values($sublist_L);
            }

            unset($sublist_S);
        }

        sort($indexSelectedConformations);
        $this->generation->setIndexSelectedConformations($indexSelectedConformations);

        // Borramos las variables
        unset($sizeGeneration, $k, $sublist_L, $sublist_S, $indexSelectedConformations);
    }
}
