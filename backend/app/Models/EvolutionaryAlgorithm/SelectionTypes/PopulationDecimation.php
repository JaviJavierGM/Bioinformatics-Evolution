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

    public function execute(){
        $sizeGeneration = $this->generation->getSizeGeneration();

        // conformaciones de la generacion, ordenadas de forma descendente
        $sublist_L = $this->generation->getOrderedConformations(false);

        echo "size generation (N): ".$sizeGeneration."<br>";

        // Punto de corte para sublist_L
        $cut = rand(($sizeGeneration / 2), $sizeGeneration);
        var_dump($cut);
        
        $sublist_S = array();
        for($i=0; $i<$cut; $i++){
            array_push($sublist_S, $sublist_L[$i]);
        }

        // Formamos el subconjunto S de C ($cut) elementos que será para obtener las conformaciones seleccionadas
        echo "sublista S:";
        foreach($sublist_S as $conformation){
            var_dump($conformation->getFitness());
        }

        // Pasamos los primeros C ($cut) individuos de la lista S a las conformaciones selecciondas
        for($i=0; $i<$cut; $i++){
            array_push($this->selectedConformations, $sublist_S[$i]);
        }

        echo "sizeGeneration - cut ";
        var_dump($sizeGeneration - $cut);

        // Completamos las conformaciones que faltan para tener el arreglo de conformaciones seleccionadas completo
        // generando una posicion aleatoria de 0 a C ($cut), que seria el tamaño de la lista S 
        for($i=0; $i<($sizeGeneration - $cut); $i++){
            $posRandom = rand(0, $cut-1);
            array_push($this->selectedConformations, $sublist_S[$posRandom]);
        }

        echo "selected conformations: ";
        foreach($this->selectedConformations as $conformation){
            var_dump($conformation->getFitness());
        }

        die();

    }
}
