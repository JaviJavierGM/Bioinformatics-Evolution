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
        echo "------------------------------------------------------------ <br>";
        echo "----> Operador Population decimation <br>";
        $sizeGeneration = $this->generation->getSizeGeneration();
        // Numero de conformaciones a seleccionar con el torneo
        if(!is_null($conformationsToSelectParemeter)){
            $conformationsToSelect = $conformationsToSelectParemeter;
        }else{
            $conformationsToSelect = $sizeGeneration;
        }

        // conformaciones de la generacion, ordenadas de forma descendente
        $sublist_L = $this->generation->getOrderedConformations(false);

        echo " > Fitness de las conformaciones de la sublista L, ordenadas de forma descendente: <br>"; 
        for($i=0; $i<$sizeGeneration; $i++){
            // var_dump( $sublist_L[$i]->getFitness() );
            echo "conformations[".$i."] = ".$sublist_L[$i]->getFitness()." <br>";
        }

        // Punto de corte para sublist_L
        $cut = rand(($sizeGeneration / 2), $sizeGeneration-1);
        echo " > Punto de corte: ".$cut."<br>";
        
        $sublist_S = array();
        for($i=0; $i<$cut; $i++){
            array_push($sublist_S, $sublist_L[$i]);
        }

        // Formamos el subconjunto S de C ($cut) elementos que será para obtener las conformaciones seleccionadas
        echo " > Sublista S: <br>";
        for($i=0; $i<$cut; $i++){
            // var_dump( $sublist_L[$i]->getFitness() );
            echo "sublist_S[".$i."] = ".$sublist_L[$i]->getFitness()." <br>";
        }


        // Pasamos los primeros C ($cut) individuos de la lista S a las conformaciones selecciondas
        for($i=0; $i<$cut; $i++){
            array_push($this->selectedConformations, $sublist_S[$i]);
        }

        echo " > Conformaciones faltantes, a elegir de forma aleatoria = ".($sizeGeneration - $cut)."<br>";

        // Completamos las conformaciones que faltan para tener el arreglo de conformaciones seleccionadas completo
        // generando una posicion aleatoria de 0 a C ($cut), que seria el tamaño de la lista S 
        for($i=0; $i<($sizeGeneration - $cut); $i++){
            $posRandom = rand(0, $cut-1);
            array_push($this->selectedConformations, $sublist_S[$posRandom]);
        }

        unset($sizeGeneration, $sublist_L, $cut, $sublist_S);

        echo "<br>----> FIN Operador Population decimation <br>";
        echo "------------------------------------------------------------ <br>";
    }
}
