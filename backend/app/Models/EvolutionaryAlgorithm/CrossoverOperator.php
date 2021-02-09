<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class CrossoverOperator extends Model
{
    use HasFactory;

    public $parent_one;
    public $parent_two;
    public $children_one;
    public $children_two;

    abstract public function execute($lengthHpString);

}
