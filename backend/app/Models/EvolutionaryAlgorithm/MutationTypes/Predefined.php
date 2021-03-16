<?php

namespace App\Models\EvolutionaryAlgorithm\MutationTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\MutationOperator;

class Predefined extends MutationOperator
{
    use HasFactory;

    public static function execute($generation, $i) {
        $parents = array();
        $parentOne = $generation->getParentsList()[$i]->getParent1();
        $parentTwo = $generation->getParentsList()[$i]->getParent2();        
        $temporalParent = $generation->getParentsList()[$i];

        array_push($parents, $parentOne);
        array_push($parents, $parentTwo);
        array_push($parents, $temporalParent);

        return $parents;
    }
}
