<?php

namespace App\Models\EvolutionaryAlgorithm\SelectionTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\SelectionOperator;
// use App\Models\EvolutionaryAlgorithm\Generation;

class Roulette extends SelectionOperator
{
    use HasFactory;

    public function __construct($generation){
        $this->generation = $generation;
    }

    public function execute(){
        $sizeGeneration = count($this->generation->getConformations());
        $totalFitness = $this->generation->getTotalFitness() * -1;

        // Calcular el porcentaje de seleccion de cada conformacion de la generacion
        $arrayPercentSelection = array();
        foreach($this->generation->getConformations() as $conformation){
            array_push($arrayPercentSelection, ($conformation->getFitness() * -1 / $totalFitness ));
        }

        var_dump($arrayPercentSelection);

        // Seleccionamos las conformaciones a cruzar
        for($i=0; $i<$sizeGeneration; $i++){
            // Generamos el porcentaje de la ruleta que debemos buscar
            $random = $this->decimalRandom();
            var_dump($random);
            $flag = true;
            $j=0;
            $sumPercentSelection = 0; // Guarda la suma de los porcentajes de las conformaciones
            // Buscamos la conformacion que pertenezca a ese porcentaje de la ruleta
            while($flag && $j < $sizeGeneration){
                $sumPercentSelection += $arrayPercentSelection[$j];
                if($sumPercentSelection >= $random){
                    // Si el porcentaje de seleccion de la conformacion corresponde con el generado
                    // se guarda esa conformacion como en las conformaciones seleccionadas
                    array_push($this->selectedConformations, $this->generation->getConformations()[$j]);
                    $flag=false;
                }else{
                    // Si no cumple, entonces continuamos buscando con la siguiente conformacion
                    $j++;
                }
            }            
        }

        foreach($this->selectedConformations as $conformation){
            var_dump($conformation->getFitness());
        }



        
                
        die();
    }
}
