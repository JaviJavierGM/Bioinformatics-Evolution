<?php

namespace App\Models\EvolutionaryAlgorithm\SelectionTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\SelectionOperator;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\Roulette;

class Tournament extends SelectionOperator
{
    use HasFactory;

    public $percent;

    public function __construct($generation, $percent){
        $this->generation = $generation;
        $this->percent = $percent;
    }

    public function execute($conformationsToSelectParemeter=null){
        echo "------------------------------------------------------------ <br>";
        echo "----> Operador Tournament <br>";
        $sizeGeneration = $this->generation->getSizeGeneration();
        // Numero de conformaciones a seleccionar con el torneo
        if(!is_null($conformationsToSelectParemeter)){
            $conformationsToSelect = $conformationsToSelectParemeter;
        }else{
            $conformationsToSelect = $sizeGeneration;
        }

        $k = round( (($this->percent / 100) * $sizeGeneration), null, PHP_ROUND_HALF_DOWN); // son las k conformaciones a elegir con la ruleta
        echo " > K conformaciones a elegir con la ruleta: ".$k." <br>";

        echo " > Fitness de las conformaciones de la generacion: <br>";
        for($i=0; $i<$sizeGeneration; $i++){
            echo "conformation[".$i."]= ".$this->generation->getConformations()[$i]->getFitness()." <br>";
        }

        // Ejecutamos el Tournament las veces necesarias para conseguir los elementos
        // necesarios para el cruce
        for($i=0; $i<$conformationsToSelect; $i++){
            echo "<br> --- Ejecucion del torneo numero: ".$i." <br>";
            $roulette = new Roulette($this->generation);
            $roulette->execute($k);
            $sublist_S= $roulette->getSelectedConformations();

            echo " fitness de la sublista S: <br>";
            for($j=0; $j<$k; $j++){
                echo "sublist_S[".$j."]= ".$sublist_S[$j]->getFitness()." <br>";
            }
            
    
            // Buscamos la mejor conformacion de las seleccionadas con la ruleta
            // Inicializamos bestconformation con la primera posicion de las seleccionadas con la ruleta
            $bestConformation = $sublist_S[0];
    
            // Buscamos en todas las conformaciones seleccionadas si hay otra con un mejor fitness
            foreach($sublist_S as $conformation){
                if(($bestConformation->getFitness()*-1) < ($conformation->getFitness()*-1)){
                    // Si la hay, reemplazamos bestConformation por la conformacion encontrada
                    $bestConformation = $conformation;
                }
            }

            echo " > La mejor conformacion encontrada de la sublista S es con fitness: ".$bestConformation->getFitness()."<br>";

            // Guardamos la mejor conformacion en las conformaciones seleccionadas
            array_push($this->selectedConformations, $bestConformation);
        }

        // Borramos todas las variables creadas
        unset($sizeGeneration, $k, $roulette, $bestConformation, $sublist_S);

        echo "<br>----> FIN Operador Tournament <br>";
        echo "------------------------------------------------------------ <br>";
    }

}
