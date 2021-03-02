<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class CoupleFormation extends Model
{
    use HasFactory;

    private $generation;

    public function __construct($generation) {
        $this->generation = $generation;
    }

    abstract public function coupleFormation();

    public function make_seed() {
        list($usec, $sec) = explode(' ', microtime());
        return (float) $sec + ((float) $usec * 100000);
    }

}
