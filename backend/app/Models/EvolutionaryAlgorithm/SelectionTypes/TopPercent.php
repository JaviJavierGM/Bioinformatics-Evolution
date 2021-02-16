<?php

namespace App\Models\EvolutionaryAlgorithm\SelectionTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\SelectionOperator;

class TopPercent extends SelectionOperator
{
    public $percent;

    public function __construct($generation, $percent){
        $this->generation = $generation;
        $this->percent = $percent;
    }

    public function execute(){
        $sizeGeneration = $this->generation->getSizeGeneration();
        $k = intval( ($this->percent / 100) * $sizeGeneration ); // k mejores coformaciones a seleccionar

        // conformaciones de la generacion, ordenadas de forma ascendente
        $sublist_L = $this->generation->getConformations(); 
        sort($sublist_L);

        // sublista S con los mejores k conformaciones segun su fitness
        $sublist_S = array();
        for($i=0; $i<$k; $i++){
            array_push($sublist_S, $sublist_L[$i]);
        }

        echo "sublista S:";
        foreach($sublist_S as $conformation){
            var_dump($conformation->getFitness());
        }

        // Seleccionamos las conformaciones necesarias para el cruce eligiendo de forma 
        // aleatoria un elemento de la sublista s y la agregamos a las conformaciones seleccionadas
        for($i=0; $i<$sizeGeneration; $i++){
            $posRandom = rand(0, sizeof($sublist_S)-1);
            array_push($this->selectedConformations, $sublist_S[$posRandom]);
        }        
        echo "selected conformations:";
        foreach($this->selectedConformations as $conformation){
            var_dump($conformation->getFitness());
        }

        die();

    }
}
