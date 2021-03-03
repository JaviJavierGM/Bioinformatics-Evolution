<?php

namespace App\Models\EvolutionaryAlgorithm\CoupleFormationTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\CoupleFormation;

class RankGACoupleFormation extends CoupleFormation
{
    use HasFactory;

    public function __construct($generation) {
        $this->generation = $generation;
    }

    public function coupleFormation() {
        
    }

}
