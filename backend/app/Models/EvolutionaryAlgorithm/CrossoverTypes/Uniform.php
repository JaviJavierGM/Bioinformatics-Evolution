<?php

namespace App\Models\EvolutionaryAlgorithm\CrossoverTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uniform extends Model
{
    use HasFactory;

    private $cuts;

    public function __construct($parent_one, $parent_two, $crossover_probability) {
        $this->parent_one = $parent_one;
        $this->parent_two = $parent_two;
        $this->crossover_probability = $crossover_probability;
        $this->cuts = array();
        srand($this->make_seed());
    }

    public function execute($lengthHpString) {
        echo 'este es el metodo execute del operador genetico crossoverUniform';
        if($this->crossover_probability > $this->decimalRandom()) {
            for ($i=0; $i < $lengthHpString; $i++) { 
                array_push($this->cuts, rand(0, 1));
            }
        }
        var_dump($this->cuts);
        die();
    }
}
