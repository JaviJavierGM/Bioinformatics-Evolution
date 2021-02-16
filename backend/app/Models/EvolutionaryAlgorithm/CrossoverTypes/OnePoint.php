<?php

namespace App\Models\EvolutionaryAlgorithm\CrossoverTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\CrossoverOperator;

class OnePoint extends CrossoverOperator
{
    use HasFactory;

    private $cut;

    public function __construct($parent_one, $parent_two, $crossover_probability) {
        $this->parent_one = $parent_one;
        $this->parent_two = $parent_two;
        $this->crossover_probability = $crossover_probability;
        srand($this->make_seed()); 
    }

    public function execute($lengthHpString) {
        echo 'Parent one: ';
        $this->printArray($this->parent_one);
        
        echo 'Parent two: ';
        $this->printArray($this->parent_two);

        // Generar el punto de corte 
        if($this->crossover_probability > $this->decimalRandom()) {
            $this->cut = rand(0, $lengthHpString-1); 
            $this->cut += 1;

            echo '<br/>La seccion de corte es: '.$this->cut.'<br/><br/>';

            // Generar los dos nuevos hijos tomando como referencia el punto de corte.
            for($i=0; $i < $this->cut; $i++) { 
                $this->children_one[$i] = $this->parent_one[$i];
                $this->children_two[$i] = $this->parent_two[$i];
            }

            for($i=$this->cut; $i < sizeof($this->parent_two); $i++) {
                $this->children_one[$i] = $this->parent_two[$i];
                $this->children_two[$i] = $this->parent_one[$i];
            }
        } else {
            echo '<br/>La probabilidad de cruce NO es mayor al real random!<br/><br/>';
            $this->children_one = $this->parent_one;
            $this->children_two = $this->parent_two;
        }

        echo 'Children one: ';
        $this->printArray($this->children_one);
        
        echo 'Children two: ';
        $this->printArray($this->children_two);
    }
}
