<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\Conformation;
use App\Models\EvolutionaryAlgorithm\Generation;
use App\Models\EvolutionaryAlgorithm\Fitness;
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
    protected $dimension_type;
    protected $function_type;
    protected $alphaValue;

    public function __construct($hpString, $typeSpace, $correlatedMatrix, $dimension_type, $function_type, $alphaValue) {
        $this->hpSecuence = $hpString;
        $this->typeSpace = $typeSpace;
        $this->correlatedMatrix = $correlatedMatrix;
        $this->hpLength = strlen($this->hpSecuence);    
        $this->dimension_type = $dimension_type;
        $this->function_type = $function_type;
        $this->alphaValue = $alphaValue;    
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
            
            // Lineas para detener el proceso y solo verificar la generacion de puntos
            // echo "<br><br> --------------------------------------------------------- YA ACABO DE GENERAR PUNTOS! <br><br>";
            // var_dump($this->points);       die();

            // $fitness = new Fitness(points)->getFitness();
            $fitness = new Fitness($this->points, $this->dimension_type, $this->function_type, $this->alphaValue);
            $fitness = $fitness->getFitness();
            // echo '<strong>Fitnes del punto # </strong>'.($i+1).': '.$fitness.'<br>';
            // die();
            if($fitness == 0) {
                --$i;
                continue;
            }
            $conformation = new Conformation($this->points);
            $conformation->setFitness($fitness);

            array_push($conformations, $conformation); // Agregar la confromacion al array de conformaciones
        }

        // var_dump($this->points);
        for($i=0; $i<sizeof($conformations); $i++) {
            // echo 'Soy el punto numero #'.($i+1).'Mi fitness es: '.$conformations[$i]->getFitness().'<br>';
        }

        $generation = new Generation($conformations);
        // calcular Dmaxp
        // calcular radioGiroP
        return $generation;
    }

    public function generatePoints($pointsChildren) {
        // echo 'Este metodo genera los puntos';

        if($this->typeSpace == 'correlated') {
            // Obtener el x & y en caso de ser correlated
            // points.add(new Point(main.getBoard().getOrigen().x, main.getBoard().getOrigen().y, 0, 0, HPsec.charAt(0)));
            array_push($this->points, new Point(0, 2, 0, $this->hpSecuence[0], 0));
        } else {            
            array_push($this->points, new Point(0, 0, 0, $this->hpSecuence[0], 0));
        }

        // $this->points[0]->setValueX(2);
        // $this->points[0]->setValueY(1);

        for ($i=1; $i < $this->hpLength; $i++) {
            // echo "<br><br> ---- Estoy generando el punto ".$i." ---- <br><br>";
            // var_dump($i);
            $i = $this->doPoints($pointsChildren, $i);            
            // var_dump($i);
        }
        
    }
    
    abstract public function doPoints($childPoints_C, $i);

}
