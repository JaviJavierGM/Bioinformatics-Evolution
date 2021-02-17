<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class CrossoverOperator extends Model
{
    use HasFactory;

    public $parent_one;
    public $parent_two;
    public $children_one;
    public $children_two;
    public $crossover_probability;

    abstract public function execute($lengthHpString);

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

    public function printArray($array) {
        echo '[ ';
        for($i = 0; $i < sizeof($array); $i++) {
            echo $array[$i].', ';
        }
        echo ' ]'.'<br/>';
    }

}
