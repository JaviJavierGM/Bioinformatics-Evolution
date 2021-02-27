<?php

namespace App\Models\EvolutionaryAlgorithm\SelectionTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\SelectionOperator;

class TopPercent extends SelectionOperator
{
    use HasFactory;

    public $percent;

    public function __construct($generation, $percent){
        $this->generation = $generation;
        $this->percent = $percent;
    }

    public function execute($conformationsToSelectParemeter=null){
        echo "------------------------------------------------------------ <br>";
        echo "----> Operador Top Percent <br>";
        $sizeGeneration = $this->generation->getSizeGeneration();
        // Numero de conformaciones a seleccionar con el torneo
        if(!is_null($conformationsToSelectParemeter)){
            $conformationsToSelect = $conformationsToSelectParemeter;
        }else{
            $conformationsToSelect = $sizeGeneration;
        }

        $k = round( (($this->percent / 100) * $sizeGeneration), null, PHP_ROUND_HALF_DOWN); // k mejores coformaciones a seleccionar
        echo " > K por ciento a seleccionar de las mejores conformaciones: ".$k." <br>";

        // conformaciones de la generacion, ordenadas de forma descendente
        $sublist_L = $this->generation->getOrderedConformations(false);
        echo " > Fitness de las conformaciones de la sublista L, ordenadas de forma descendente: <br>"; 
        for($i=0; $i<$sizeGeneration; $i++){
            // var_dump( $sublist_L[$i]->getFitness() );
            echo "conformations[".$i."] = ".$sublist_L[$i]->getFitness()." <br>";
        }


        // sublista S con los mejores k conformaciones segun su fitness
        $sublist_S = array();
        // ---------------------------------------------------
        // for($i=0; $i<$k; $i++){
        //     array_push($sublist_S, $sublist_L[$i]);
        // }
        // ---------------------------------------------------

        // echo " > Fitness de las conformaciones de la sublista S (las k mejores conformaciones): <br>"; 
        // for($i=0; $i<$k; $i++){
        //     // var_dump( $sublist_L[$i]->getFitness() );
        //     echo "conformations[".$i."] = ".$sublist_S[$i]->getFitness()." <br>";
        // }

        $helpers = new \Helpers();

        // Seleccionamos las conformaciones necesarias para el cruce eligiendo de forma 
        // aleatoria un elemento de la sublista s y la agregamos a las conformaciones seleccionadas
        // for($i=0; $i<$conformationsToSelect; $i++){
        // -------------------------------------------------------
        while(sizeof($this->indexSelectedConformations) < $conformationsToSelect){
            
            if(sizeof($sublist_L) > $k) {
                for($i=0; $i < $k; $i++) {
                    $sublist_S[$i] = $sublist_L[$i];                    
                    // array_push($sublist_S, $sublist_L[$i]);
                }
            } else {
                for($i=0; $i < sizeof($sublist_L); $i++){
                    $sublist_S[$i] = $sublist_L[$i];                    
                    // array_push($sublist_S, $sublist_L[$i]);
                }
            }
            
            $posRandom = rand(0, sizeof($sublist_S)-1);
            var_dump($posRandom);
            echo " > Elemento aleatorio a seleccionar de la sublist_S: ".$posRandom." con fitness: ".$sublist_S[$posRandom]->getFitness()." <br>";
            // array_push($this->selectedConformations, $sublist_S[$posRandom]);
            
            $returnIndexOf = $helpers->indexOf($this->indexSelectedConformations, $sublist_S[$posRandom]->getPositionIndex());
            $returnLastIndexOf = $helpers->lastIndexOf($this->indexSelectedConformations, $sublist_S[$posRandom]->getPositionIndex());

            if( $returnIndexOf == $returnLastIndexOf ) {
                echo "<br>--------------------> si entro idexOf == lastIndeOf <br>";
                array_push($this->indexSelectedConformations, $sublist_S[$posRandom]->getPositionIndex());
                array_push($this->selectedConformations, $sublist_S[$posRandom]);
            }else{
                echo "entro al else";
                unset($sublist_L[$posRandom]);
                $sublist_L = array_values($sublist_L);
                // var_dump($sublist_L);
                // die();
            }

            unset($sublist_S);

        }
        // -------------------------------------------------------

        // Borramos las variables
        unset($sizeGeneration, $k, $sublist_L, $sublist_S);

        echo "<br>----> FIN Operador TopPercent <br>";
        echo "------------------------------------------------------------ <br>";
    }
}
