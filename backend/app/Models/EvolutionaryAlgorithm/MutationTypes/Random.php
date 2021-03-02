<?php

namespace App\Models\EvolutionaryAlgorithm\MutationTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\MutationOperator;
use App\Models\Conformation;

class Random extends MutationOperator
{
    use HasFactory;

}
