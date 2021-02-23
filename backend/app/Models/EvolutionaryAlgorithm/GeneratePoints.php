<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\Conformation;
use App\Models\EvolutionaryAlgorithm\Generation;

abstract class GeneratePoints extends Model
{
    use HasFactory;

    protected $hpSecuence;
    protected $hpLength;
    protected $points;
    protected $rand;

    public function __construct($hpString) {
        $this->hpSecuence = $hpString;
        $this->hpLength = strlen($this->hpSecuence);
    }

    public function initializeGeneration($conformationsNumbers) {
        echo 'Este metodo inicializa la generacion/poblacion!<br>';

        $conformations = array();

        for($i = 0; $i < $conformationsNumbers; $i++) {
            $pointsChildren = array();
            $this->points = array();

            $this->generatePoints($pointsChildren);

            // $fitness = new Fitness(points)->getFitness();
            $fitness = 2;
            if($fitness == 0) {
                --$i;
                continue;
            }

            //array_push($conformations, new Conformation($this->points)); // Agregar la confromacion al array de conformaciones
        }

        $generation = new Generation($conformations);
        // calcular Dmaxp
        // calcular radioGiroP
        return $generation;
    }

    public function generatePoints($pointsChildren) {
        echo 'Este metodo genera los puntos';
    }
    
    abstract public function doPoints($puntos, $i);

}
