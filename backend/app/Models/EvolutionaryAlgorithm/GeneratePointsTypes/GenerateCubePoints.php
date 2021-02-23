<?php

namespace App\Models\EvolutionaryAlgorithm\GeneratePointsTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\GeneratePoints;

class GenerateCubePoints extends GeneratePoints
{
    use HasFactory;

    public function doPoints($puntos, $i) {
        echo 'Metodo doPoints Cubic';
    }
}
