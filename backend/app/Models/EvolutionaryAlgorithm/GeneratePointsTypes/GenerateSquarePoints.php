<?php

namespace App\Models\EvolutionaryAlgorithm\GeneratePointsTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\GeneratePoints;
use App\Models\EvolutionaryAlgorithm\Point;

class GenerateSquarePoints extends GeneratePoints
{
    use HasFactory;

    // construct temporal --- borrar
    // public function __construct(){
    //     echo "generate points square construct! <br>";
    // }

    public function generateSquarePoint($movVectorValue, $letter, $previousPoint ) {
        $point;
        switch ($movVectorValue) {
            case 0:
                echo "Case 0 <br>";
                $point = new Point($previousPoint->getValueX()+1, $previousPoint->getValueY(), 0, $letter, 0);
                $point->setMovVectorValue($movVectorValue);
                $point->setWay1(false);
                break;

            case 1:
                echo "Case 1 <br>";
                $point = new Point($previousPoint->GetValueX()-1, $previousPoint->getValueY(), 0, $letter, 1);
                $point->setMovVectorValue($movVectorValue);
                $point->setWay0(false);
                break;

            case 2:
                echo "Case 2 <br>";
                $point = new Point($previousPoint->getValueX(), $previousPoint->getValueY()+1, 0, $letter, 2);
                $point->setWay3(false);
                break;

            case 3:
                echo "Case 3 <br>";
                $point = new Point($previousPoint->getValueX(), $previousPoint->getValueY()-1, 0, $letter, 3);
                $point->setWay2(false);
                break;

            default:
                echo "Default case";
                break;
        }

        return $point;
    }

    public function doPoints($childPoints_C, $i) {
        echo 'Metodo doPoints Square <br>';

        $isOk = true;
        $stringBuilder = ""; // StringBuilder sb = new StringBuilder();
        $widthMatrix;
        $heightMatrix;
        $pointsMatrix;

        if ($this->typeSpace == "correlated") {
            echo "Space CORRELATED! <br>";

            $widthMatrix = sizeof($this->correlatedMatrix);
            $heightMatrix = sizeof($this->correlatedMatrix[0]);
            $pointsMatrix = $this->correlatedMatrix;
            echo "widthMatrix = ".$widthMatrix."<br>";
            echo "heightMatrix = ".$heightMatrix."<br>";

            do {
                // switch (rand( 0, 3)) {
                switch (0) {  
                    case 0: // Derecha
                        echo "Case 0 - Derecha <br>";

                        if ( ((int)$this->points[$i-1]->getValueX()) < ($widthMatrix-1) ) {

                            var_dump($pointsMatrix[ ((int)($this->points[$i-1]->getValueX())+1) ][ ((int)($this->points[$i-1]->getValueY())) ]);
                            //if ( $pointsMatrix[ ((int)($this->points[$i-1]->getValueX())+1) ][ ((int)($this->points[$i-1]->getValueY())) ] )
                        }

                        // [(int) (points.get(i - 1).getyValue())]

                        break;

                    case 1: // Izquierda
                        echo "Case 1 - Izquierda <br>";
                        break;

                    case 2: // Abajo
                        echo "Case 2 - Abajo <br>";
                        break;

                    case 3: // Arriba
                        echo "Case 3 - Arriba <br>";
                        break;

                    default:
                        echo "Default case";
                        break;
                }

            } while (!$isOk);
            // return $i;
        }

        echo "FIN!!"; die();
    }
}
