<?php

namespace App\Models\EvolutionaryAlgorithm\MutationTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Conformation;

class Random extends Model
{
    use HasFactory;

    private $conformations = array();

    public function __construct() {
        $confo1 = new Conformation();
        $confo1->setFitness(89);
        $confo2 = new Conformation();
        $confo1->setFitness(-1);
        $confo3 = new Conformation();
        $confo1->setFitness(-91);
        $confo4 = new Conformation();
        $confo1->setFitness(19);

        array_push($this.conformations, $confo1);
        array_push($this.conformations, $confo2);
        array_push($this.conformations, $confo3);
        array_push($this.conformations, $confo4);

    }
}
