<?php

namespace App\Models\EvolutionaryAlgorithm\CrossoverTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\CrossoverOperator;

class Uniform extends CrossoverOperator
{
    use HasFactory;


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

        if($this->crossover_probability > $this->decimalRandom()) {
            $this->children_one = $this->generateChildren($lengthHpString);
            $this->children_two = $this->generateChildren($lengthHpString);
            echo '<br>';
        } else {
            echo '<br>La probailidad de cruce no es mayor que el numero random!<br>';

            $this->children_one = $this->parent_one;
            $this->children_two = $this->parent_two;
            echo '<br>';
        }
        
        echo 'Children one: ';
        $this->printArray($this->children_one);
        
        echo 'Children two: ';
        $this->printArray($this->children_two);
    }

    public function generateChildren($lengthHpString) {
        $array = array();
        echo '<br/> Seleccion del gen: [ ';
        for ($i=0; $i < $lengthHpString; $i++) { 
            $parentSelected = rand(0, 1);

            echo $parentSelected.' ';

            // Seleccion del padre que contribuirá el gen al hijo
            if ($parentSelected == 0) {
                $array[$i] = $this->parent_one[$i];
            } else {
                $array[$i] = $this->parent_two[$i];
            }
        }
        
        echo ' ]<br/>';
        return $array;
    }
}
