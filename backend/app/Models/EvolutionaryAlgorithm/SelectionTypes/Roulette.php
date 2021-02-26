<?php

namespace App\Models\EvolutionaryAlgorithm\SelectionTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\SelectionOperator;

class Roulette extends SelectionOperator
{
    use HasFactory;

    public function __construct($generation) {
        $this->generation = $generation;
    }

    public function execute($conformationsToSelectParemeter=null) {
        
        $sizeGeneration = $this->generation->getSizeGeneration();
        // Numero de conformaciones a seleccionar con la ruleta
        if(!is_null($conformationsToSelectParemeter)) {
            $conformationsToSelect = $conformationsToSelectParemeter;
        }else {
            $conformationsToSelect = $sizeGeneration;
        }        

        echo " > Generacion inicial --------- : <br>"; 
        for($i=0; $i<$sizeGeneration; $i++){
            echo "conformations[".$i."] fitness = ".$this->generation->getConformations()[$i]->getFitness()." <br>";
            echo "conformations[".$i."] positionIndex = ".$this->generation->getConformations()[$i]->getPositionIndex()." <br>";
        }

        $totalFitness = $this->generation->getTotalFitness() * -1;
        
        echo " > Fitness total de toda la generacion: ".$totalFitness." <br>";

        // Ordenar las coformaciones de manera ascendente
        $orderedConformations = $this->generation->getOrderedConformations(true);

        echo " > Fitness de las conformaciones, ordenadas de forma ascendente: <br>"; 
        for($i=0; $i<$sizeGeneration; $i++){
            // var_dump( $orderedConformations[$i]->getFitness() );
            echo "conformations[".$i."] fitness = ".$orderedConformations[$i]->getFitness()." <br>";
            echo "conformations[".$i."] positionIndex = ".$orderedConformations[$i]->getPositionIndex()." <br>";
        }


        echo " > Probabilidad de seleccion de las conformaciones, ordenado de forma ascendente: <br>";
        // Calcular el porcentaje de seleccion de cada conformacion de la generacion
        $arrayPercentSelection = array();
        foreach($orderedConformations as $conformation){
            array_push($arrayPercentSelection, ($conformation->getFitness() * -1 / $totalFitness ));
        }

        for($i=0; $i<$sizeGeneration; $i++){
            // var_dump( $arrayPercentSelection[$i] );
            echo "arrayPercentSelection[".$i."] = ".$arrayPercentSelection[$i]." <br>";
        } 
        $indexConformationsSelected = array();
        

        // Seleccionamos las conformaciones
        // for($i=0; $i<$conformationsToSelect; $i++){
        while(sizeof($indexConformationsSelected) < $sizeGeneration){
            echo "<br> > Conformacion a seleccionar numero: ".$i."<br>";
            // Generamos el porcentaje de la ruleta que debemos buscar
            $random = $this->decimalRandom();
            echo " > Valor de la ruleta: ".$random." <br>";
            $flag = true;
            $j=0;
            $sumPercentSelection = 0; // Guardara la suma de los porcentajes de las conformaciones

            $helpers = new \Helpers();

            // Buscamos la conformacion que pertenezca a ese porcentaje de la ruleta
            // while($flag && $j < $sizeGeneration){
            for($j=0; $j<$sizeGeneration; $j++){                
                $sumPercentSelection += $arrayPercentSelection[$j];
                // echo "suma parcial: ".$sumPercentSelection." --- posicion del array de porcentajes: ".$j." <br>";
                if($sumPercentSelection >= $random){
                    // Si el porcentaje de seleccion de la conformacion corresponde con el generado
                    // se guarda esa conformacion en las conformaciones seleccionadas

                    echo " --- La ruleta SELECCIONO la conformacion en la pos: ".$j."<br>";

                    $returnIndexOf = $helpers->indexOf($indexConformationsSelected, $orderedConformations[$j]->getPositionIndex());
                    $returnLastIndexOf = $helpers->lastIndexOf($indexConformationsSelected, $orderedConformations[$j]->getPositionIndex());

                    if( $returnIndexOf == $returnLastIndexOf ) {
                        echo "si entro idexOf == lastIndeOf <br>";
                        array_push($indexConformationsSelected, $orderedConformations[$j]->getPositionIndex());
                        array_push($this->selectedConformations, $orderedConformations[$j]);
                        // $flag=false;
                        break;
                    }

                    // array_push($this->selectedConformations, $orderedConformations[$j]);
                    // $flag=false;
                }else{
                    // Si no cumple, entonces continuamos buscando con la siguiente conformacion
                    $j++;
                }
            }            
        }

        var_dump($indexConformationsSelected);

        // Borramos todas las variables creadas
        unset($sizeGeneration, $conformationsToSelect, $totalFitness, $orderedConformations, $arrayPercentSelection);
       
        echo "<br>----> FIN Operador Roulette <br>";
        echo "------------------------------------------------------------ <br>";

    }
}
