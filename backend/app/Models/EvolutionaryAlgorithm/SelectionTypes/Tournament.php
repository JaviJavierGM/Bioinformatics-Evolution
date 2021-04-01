<?php

namespace App\Models\EvolutionaryAlgorithm\SelectionTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\SelectionOperator;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\Roulette;
use App\Models\EvolutionaryAlgorithm\Generation;
use App\Models\EvolutionaryAlgorithm\Conformation;
use App\Helpers\Helpers;

class Tournament extends SelectionOperator
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
        if( !is_null($conformationsToSelectParemeter) ) {
            $conformationsToSelect = $conformationsToSelectParemeter;
        } else {
            $conformationsToSelect = $sizeGeneration;
        }

        $totalFitness = $this->generation->getTotalFitness() * -1;

        if($totalFitness == 0){
            return false;
        }

        $k = round( (($this->percent / 100) * $sizeGeneration), null, PHP_ROUND_HALF_DOWN); // son las k conformaciones a elegir con la ruleta

        if($k == 0) {
            $k = 1;
        }            

        $copyOfGeneration = $this->generation->getCloneGeneration();
        
        // Ejecutamos el Tournament las veces necesarias para conseguir las conformaciones
        // necesarias para el cruce
        $indexSelectedConformations = array();
         while( sizeof($indexSelectedConformations) < $conformationsToSelect ) {

            $roulette = new Roulette($copyOfGeneration);
            $roulette->execute($k);
            $sublist_S = $copyOfGeneration->getSelectedConformations();
            
            // Buscamos la mejor conformacion de las seleccionadas con la ruleta
            // Inicializamos bestconformation con la primera posicion de las seleccionadas con la ruleta
            $bestConformation = $sublist_S[0];
    
            // Buscamos en todas las conformaciones seleccionadas si hay otra con un mejor fitness
            foreach( $sublist_S as $conformation ) {
                if( ($bestConformation->getFitness()*-1) < ($conformation->getFitness()*-1) ) {
                    // Si la hay, reemplazamos bestConformation por la conformacion encontrada
                    $bestConformation = $conformation;
                }
            }

            $returnIndexOf = Helpers::indexOf($indexSelectedConformations, $bestConformation->getPositionIndex());
            $returnLastIndexOf = Helpers::lastIndexOf($indexSelectedConformations, $bestConformation->getPositionIndex());

            if( $returnIndexOf == $returnLastIndexOf ) {
                // Guardamos la mejor conformacion en las conformaciones seleccionadas
                array_push($indexSelectedConformations, $bestConformation->getPositionIndex());
            } else {
                $copyOfGeneration->getConformations()[$bestConformation->getPositionIndex()]->setFitnessTo0();
            }

            // Borramos todas las variables creadas
            unset($roulette, $sublist_S, $bestConformation, $returnIndexOf, $returnLastIndexOf);
        }

        sort($indexSelectedConformations);
        $this->generation->setIndexSelectedConformations($indexSelectedConformations);

        // Borramos todas las variables creadas
        unset($sizeGeneration, $k, $roulette, $bestConformation, $sublist_S, $copyOfGeneration, $indexSelectedConformations);
        
        return true;
    }

}
