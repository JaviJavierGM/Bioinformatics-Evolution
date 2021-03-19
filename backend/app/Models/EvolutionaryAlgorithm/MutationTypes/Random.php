<?php

namespace App\Models\EvolutionaryAlgorithm\MutationTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\Parents;
use App\Models\EvolutionaryAlgorithm\MutationOperator;

class Random extends MutationOperator
{
    use HasFactory;

    public static function execute($generation, $i) {
        srand(Random::make_seed());
        $temporalParent = new Parents();
        switch (rand(0, 1)) {
            case 0:
                $parentOne = $generation->getParentsList()[$i]->getParent1();
                $parentTwo = $generation->getParentsList()[$i]->getParent2();        
                $temporalParent = $generation->getParentsList()[$i];
                break;
            case 1:
                $parentOne = $generation->getParentsList()[$i]->getParent2();
                $parentTwo = $generation->getParentsList()[$i]->getParent1();        
                $temporalParent->setParent1($parentOne);
                $temporalParent->setParent2($parentTwo);
                break;
            
            default:
                echo 'Case Default Mutation Random<br>';
                break;
        }
        
        $parents = array(
            'one' => $parentOne,
            'two' => $parentTwo,
            'temp' => $temporalParent
        );

        return $parents;
    }

    public static function make_seed() {
        list($usec, $sec) = explode(' ', microtime());
        return (float) $sec + ((float) $usec * 100000);
    }

}
