<?php

namespace App\Models\EvolutionaryAlgorithm\CrossoverTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\CrossoverOperator;

class TwoPointsCrossoverOperator extends CrossoverOperator
{
    use HasFactory;

    private $cut_one;
    private $cut_two;
    private $crossover_probability;

    public function __construct($parent_one, $parent_two, $crossover_probability) {
        $this->parent_one = $parent_one;
        $this->parent_two = $parent_two;
        $this->crossover_probability = $crossover_probability;
        srand($this->make_seed()); 
    }

    public function execute($lengthHpString) {
        // Generar el punto de corte 
        /*if($this->crossover_probability > $this->decimalRandom()) {
            $this->cut_one = rand(0, $lengthHpString/2); 
            $this->cut_two = rand(0, $lengthHpString/2) + $lengthHpString/2; 
        } else {
            $this->cut_one = $lengthHpString;
            $this->cut_two = $lengthHpString;
        }*/

        $this->cut_one = 2;
        $this->cut_two = 7;
        echo 'La seccion de corte_one es: '.$this->cut_one.'<br/>';
        echo 'La seccion de corte_two es: '.$this->cut_two.'<br/>';

        // Generar los dos nuevos hijos.
        for($i=0; $i < $this->cut_one; $i++) { 
            $this->children_one[$i] = $this->parent_one[$i];
            $this->children_two[$i] = $this->parent_two[$i];
        }

        for ($i=$this->cut_one; $i <= $this->cut_two ; $i++) { 
            $this->children_one[$i] = $this->parent_two[$i];
            $this->children_two[$i] = $this->parent_one[$i];
        }

        for($i=$this->cut_two + 1; $i <sizeof($this->parent_two); $i++) {
            $this->children_one[$i] = $this->parent_one[$i];
            $this->children_two[$i] = $this->parent_two[$i];
        }
    }

    public function getChildrenOne() {
        return $this->children_one;
    }

    public function getChildrenTwo() {
        return $this->children_two;
    }

    public function make_seed() {
    list($usec, $sec) = explode(' ', microtime());
    return (float) $sec + ((float) $usec * 100000);
    }

    public function decimalRandom() {
        return rand(0, 1000000) / 1000000;
    }
}
