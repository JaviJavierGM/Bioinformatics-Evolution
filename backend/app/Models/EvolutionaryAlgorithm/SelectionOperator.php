<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class SelectionOperator extends Model
{
    use HasFactory;

    public $generation;
    public $selectedConformations = array();
    public $indexSelectedConformations = array();

    
    abstract public function execute();

    public function getSelectedConformations(){
        return $this->selectedConformations;
    }

    public function getIndexSelectedConformations(){
        return $this->indexSelectedConformations;
    }

    public function make_seed() {
        list($usec, $sec) = explode(' ', microtime());
        return (float) $sec + ((float) $usec * 100000);
    }

    public function decimalRandom() {
        return rand(0, 1000000) / 1000000;
    }

}
