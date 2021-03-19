<?php

namespace App\Models\EvolutionaryAlgorithm\MutationTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\MutationOperator;

class Predefined extends MutationOperator
{
    use HasFactory;

    public static function execute($generation, $i) {        
        $parentOne = $generation->getParentsList()[$i]->getParent1();
        $parentTwo = $generation->getParentsList()[$i]->getParent2();        
        $temporalParent = $generation->getParentsList()[$i];

        $parents = array(
            'one' => $parentOne,
            'two' => $parentTwo,
            'temp' => $temporalParent
        );

        return $parents;
    }
}
