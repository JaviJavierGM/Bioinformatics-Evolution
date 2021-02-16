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

    public function execute(){
        $sizeGeneration = $this->generation->getSizeGeneration();
        $k = intval( ($this->percent / 100) * $sizeGeneration ); // son las k conformaciones a elegir con la ruleta

        foreach($this->generation->getConformations() as $conformation){
            var_dump($conformation->getFitness());
        }

        // Ejecutamos el Tournament las veces necesarias para conseguir los elementos
        // seleccionados para el cruce
        for($i=0; $i<$sizeGeneration; $i++){
            $roulette = new Roulette($this->generation);
            $roulette->execute($k);

            echo "VARDUMP DESPUES RULETA ".$i." -----";
            foreach($roulette->getSelectedConformations() as $conformation){
                var_dump($conformation->getFitness());
            }
    
            // Buscamos la mejor conformacion de las seleccionadas con la ruleta
            // Inicializamos bestconformation con la primera posicion de las seleccionadas con la ruleta
            $bestConformation = $roulette->getSelectedConformations()[0];
    
            // Buscamos en todas las conformaciones seleccionadas si hay otra con un mejor fitness
            foreach($roulette->getSelectedConformations() as $conformation){
                if(($bestConformation->getFitness()*-1) < ($conformation->getFitness()*-1)){
                    // Si la hay, reemplazamos bestConformation por la conformacion encontrada
                    $bestConformation = $conformation;
                }
            }

            // Guardamos la mejor conformacion en las conformaciones seleccionadas
            array_push($this->selectedConformations, $bestConformation);
        }

        echo "VARDUMP FINALLLL -----";
        foreach($this->selectedConformations as $conformation){
            var_dump($conformation->getFitness());
        }


        die();
    }

}
