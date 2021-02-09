<?php

namespace App\Models\EvolutionaryAlgorithm\CrossoverTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\CrossoverOperator;

class OnePointCrossoverOperator extends CrossoverOperator
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
        // Generar el punto de corte 
        if($this->crossover_probability > $this->decimalRandom()) {
            $this->cut = rand(0, $lengthHpString-1); 
            $this->cut += 1;

            echo 'La seccion de corte es: '.$this->cut.'<br/>';

            // Generar los dos nuevos hijos.
            for($i=0; $i < $this->cut; $i++) { 
                $this->children_one[$i] = $this->parent_one[$i];
                $this->children_two[$i] = $this->parent_two[$i];
            }

            for($i=$this->cut; $i <sizeof($this->parent_two); $i++) {
                $this->children_one[$i] = $this->parent_two[$i];
                $this->children_two[$i] = $this->parent_one[$i];
            }
        } else {
            $this->children_one = $this->parent_one;
            $this->children_two = $this->parent_two;
        }
    }
}
