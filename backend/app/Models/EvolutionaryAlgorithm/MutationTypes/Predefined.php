<?php

namespace App\Models\EvolutionaryAlgorithm\MutationTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predefined extends Model
{
    use HasFactory;
    private $parentOne;
    private $parentTwo;
    private $temporalParent;

    public function __construct() {
        echo 'Soy el operador de mutación predefinido!';
    }

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
