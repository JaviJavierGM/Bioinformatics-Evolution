<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class GeneratePoints extends Model
{
    use HasFactory;

    protected $hpSecuence;
    protected $hpLength;
    protected $points;
    protected $rand;  
    
    abstract public function doPoints($puntos, $i);

}
