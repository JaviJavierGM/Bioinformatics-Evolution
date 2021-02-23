<?php

namespace App\Models\EvolutionaryAlgorithm\GeneratePointsTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\GeneratePoints;

class GenerateTrianglePoints extends GeneratePoints
{
    use HasFactory;

    public function doPoints($puntos, $i) {
        echo 'Metodo ddoPoints Triangle';
    }
}
