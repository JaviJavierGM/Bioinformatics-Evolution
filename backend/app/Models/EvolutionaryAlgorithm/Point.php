<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    private $xValue;
    private $yValue;
    private $zValue;
    private $letter;
    private $movVectorValue;

    public function __construct($xValue, $yValue, $zValue, $letter, $movVectorValue) {
        $this->xValue = $xValue;
        $this->yValue = $yValue;
        $this->zValue = $zValue;
        $this->letter = $letter;
        $this->movVectorValue = $movVectorValue;
    }
}
