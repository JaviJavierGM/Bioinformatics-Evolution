<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\Conformation;
use App\Models\EvolutionaryAlgorithm\Generation;
use App\Models\EvolutionaryAlgorithm\Point;

abstract class GeneratePoints extends Model
{
    use HasFactory;

    protected $hpSecuence;
    protected $hpLength;
    protected $points;
    protected $rand;
    protected $typeSpace;
    protected $correlatedMatrix;

    public function __construct($hpString, $typeSpace, $correlatedMatrix) {
        $this->hpSecuence = $hpString;
        $this->typeSpace = $typeSpace;
        $this->correlatedMatrix = $correlatedMatrix;
        $this->hpLength = strlen($this->hpSecuence);
    }

    public function initializeGeneration($conformationsNumbers) {
        echo 'Este metodo inicializa la generacion/poblacion!<br>';

        // Arreglo que tendra las conformaciones iniciales.
        $conformations = array();

        // Generacion de los puntos para cada confromacion de la generacion/poblacion inicial.
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

        if($this->typeSpace == 'correlated') {
            array_push($this->points, new Point(0, 0, 0, '', 0));
        } else {
            array_push($this->points, new Point(0, 0, 0, '', 0));
        }

        for ($i=0; $i < $this->hpLength; $i++) {
            $i = $this->doPoints($pointsChildren, $i);
        }
    }
    
    abstract public function doPoints($points, $i);

}
