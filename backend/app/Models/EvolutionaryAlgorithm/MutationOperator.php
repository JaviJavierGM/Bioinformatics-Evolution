<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class MutationOperator extends Model
{
    use HasFactory;

    abstract public function execute();
}
