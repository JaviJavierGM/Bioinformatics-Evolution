<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class SelectionOperator extends Model
{
    use HasFactory;

    protected $generation;
    
    abstract public function execute();

    public function make_seed() {
        list($usec, $sec) = explode(' ', microtime());
        return (float) $sec + ((float) $usec * 100000);
    }

    public function decimalRandom() {
        // srand($this->make_seed());
        return rand(0, 1000000) / 1000000;
    }

}
