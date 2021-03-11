<?php

namespace App\Models\EvolutionaryAlgorithm\SelectionTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\SelectionOperator;

class PopulationDecimation extends SelectionOperator
{
    use HasFactory;

    public function __construct($generation){
        $this->generation = $generation;
    }

    public function execute($conformationsToSelectParemeter=null){
        $sizeGeneration = $this->generation->getSizeGeneration();
        // Numero de conformaciones a seleccionar con el torneo
        if(!is_null($conformationsToSelectParemeter)){
            $conformationsToSelect = $conformationsToSelectParemeter;
        }else{
            $conformationsToSelect = $sizeGeneration;
        }

        // conformaciones de la generacion, ordenadas de forma descendente
        $sublist_L = $this->generation->getOrderedConformations(false);

        // Punto de corte para sublist_L
        $cut = rand(($sizeGeneration / 2), $sizeGeneration-1);
        
        // Formamos el subconjunto S de C ($cut) elementos que será para obtener las conformaciones seleccionadas
        $sublist_S = array();
        for($i=0; $i<$cut; $i++){
            array_push($sublist_S, $sublist_L[$i]);
        }
        $indexSelectedConformations = array();
        // Pasamos los primeros C ($cut) individuos de la lista S a las conformaciones selecciondas        
        for($i=0; $i<$cut; $i++){
            array_push($indexSelectedConformations, $sublist_S[$i]->getPositionIndex());
        }

        // Completamos las conformaciones que faltan para tener el arreglo de conformaciones seleccionadas completo
        // generando una posicion aleatoria de 0 a C ($cut), que seria el tamaño de la lista S 
        for($i=0; $i<($sizeGeneration - $cut); $i++){
            $posRandom = rand(0, $cut-1);
            array_push($indexSelectedConformations, $sublist_S[$posRandom]->getPositionIndex());
        }
        
        // Dejamos solo las conformaciones a seleccionar
        for($i=sizeof($indexSelectedConformations); $i>$conformationsToSelect; $i--){
            unset($indexSelectedConformations[$i]);
            $indexSelectedConformations = array_values($indexSelectedConformations);
        }

        sort($indexSelectedConformations);

        $this->generation->setIndexSelectedConformations($indexSelectedConformations);

        // Borramos las variables
        unset($sizeGeneration, $sublist_L, $cut, $sublist_S, $indexSelectedConformations);
    }
}
