<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\Point;

use Illuminate\Support\Facades\Storage;

class CorrelatedNetwork extends Model
{
    use HasFactory;

    private $fileName;
    private $correlatedMatrix = array();       
    private $point1;
    private $point2;
    private $point3;
    private $point4;
    // -------------------------
    private $startingPoint; 
    private $width;
    private $height;
    private $amount = array();
    private $density = array();
    private $density2 = array();
    private $x1;
    private $y1;
    private $higher = 0.0;

    public function __construct($fileName, $point1, $point2, $point3, $point4){
        $this->point1 = $point1;
        $this->point2 = $point2;
        $this->point3 = $point3;
        $this->point4 = $point4;

    }

    public function readMatrix(){

        /*
        
        Falta ordenar esta funcion despues de los de las dudas
        
        */

        echo "read matriz <br>";
        $contents = Storage::get('correlatedMatrixs/pruebaMatriz01.txt');
        // $contents = Storage::get('correlatedMatrixs/cp37.txt');

        $contents .= "\n";

        $arrayTemp = array();
        $matrix = array();

        

        $upperLeft = $this->point1;
        $upperRight = $this->point2;
        
        $lowerLeft = $this->point3;
        $lowerRight = $this->point4;

        // $ladoVertical = sqrt( pow( $lowerLeft->getValueX()-$upperLeft->getValueX() ,2) + pow( $lowerLeft->getValueY()-$upperLeft->getValueY() ,2)) +1;
        // $ladoHorizontal = sqrt( pow( $upperRight->getValueX()-$upperLeft->getValueX() ,2) + pow( $upperRight->getValueY()-$upperLeft->getValueY() ,2)) +1;

        // var_dump($ladoVertical);
        // var_dump($ladoHorizontal); die();


        // $elementsTOTAL = $ladoVertical * $ladoHorizontal;
        $contElemts =0;

        // var_dump($elementsTOTAL);
        

        $contadorVertical = 0;
        $contadorHorizontal = -1;

        $arrayTempMatrix = array();
        $matrixFINAL = array();
        
        // Leer la matriz del archivo txt
        for($i=0; $i<strlen($contents); $i++){            

            if($contents[$i] == "\n"){

                // if($contadorVertical >= $upperLeft->getValueY() && $contadorVertical <= $lowerLeft->getValueY()){
                //     array_push($matrixFINAL, $arrayTempMatrix);
                //     unset($arrayTempMatrix);
                //     if(!isset($arrayTempMatrix))
                //         $arrayTempMatrix = array();

                //     if($contElemts == $elementsTOTAL)
                //         break;
                // }
                // $contadorVertical++;
                // $contadorHorizontal=-1;  

                
                array_push($matrix, $arrayTemp);
                unset($arrayTemp);                
                if(!isset($arrayTemp))
                    $arrayTemp = array();

                
            
            }else{
                
                if($contents[$i] == "0" || $contents[$i] == "1"){
                    array_push($arrayTemp, (int)$contents[$i]);
                    
                    // $contadorHorizontal++;

                    // if($contadorVertical >= $upperLeft->getValueY() && $contadorVertical <= $lowerLeft->getValueY()){
                    //     if($contadorHorizontal >= $upperLeft->getValueX() && $contadorHorizontal <= $upperRight->getValueX()){
                    //         array_push($arrayTempMatrix, (int)$contents[$i]);
                    //         $contElemts++;

                    //     }
                    // }

                }                            
            }
            
        }        

        echo "<br> termino de leer matriz <br>";

        // var_dump($contadorHorizontal);
        // var_dump($contadorVertical);

        //var_dump($matrixFINAL);
        
        // var_dump($matrix);

        // Copiar solo la parte seleccionada
        $arrayTemp = array();

        
        $ladoVertical = (int)sqrt( pow( $lowerLeft->getValueX()-$upperLeft->getValueX() ,2) + pow( $lowerLeft->getValueY()-$upperLeft->getValueY() ,2)) +1;
        $ladoHorizontal = (int)sqrt( pow( $upperRight->getValueX()-$upperLeft->getValueX() ,2) + pow( $upperRight->getValueY()-$upperLeft->getValueY() ,2)) +1;

        // echo "lado vertical:";
        // var_dump($ladoVertical);
        // echo "lado horizontal:";
        // var_dump($ladoHorizontal);

        // var_dump($this->point1->getValueX());
        // var_dump($this->point3->getValueX());
        // var_dump($this->point2->getValueY());
        
        for($i=$this->point1->getValueX(); $i<$this->point1->getValueX()+$ladoVertical; $i++){

            if(!isset($arrayTemp))
                $arrayTemp = array();

            for($j=$this->point1->getValueY(); $j<$this->point1->getValueY()+$ladoHorizontal; $j++){
                array_push($arrayTemp, $matrix[$i][$j]);
            }

            array_push($this->correlatedMatrix, $arrayTemp);
            unset($arrayTemp);

        }

        // var_dump($this->correlatedMatrix); 

        // var_dump(sizeof($this->correlatedMatrix[0]));
        // var_dump(sizeof($this->correlatedMatrix));
        // die();

        // $this->width = (int)$ladoHorizontal;
        // $this->height = (int)$ladoVertical;

        $this->width = sizeof($this->correlatedMatrix[0]);
        $this->height = sizeof($this->correlatedMatrix);

        echo "width";
        var_dump($this->width);
        echo "height";
        var_dump($this->height);
        echo "-------------------------------------";

    }

    public function generateStartingPoint() {        
        
        for($i=0; $i<4; $i++) {
            array_push($this->amount, 0);
            array_push($this->density, 0);
            array_push($this->density2, 0);
        }
        
        if( ($this->width % 2) == 1 ) {
            $this->x1 = intdiv($this->width, 2) + 1;
        } else {
            $this->x1 = intdiv($this->width, 2);
        }        

        if( ($this->height % 2) == 1 ) {
            $this->y1 = intdiv($this->height, 2) + 1;
        } else {
            $this->y1 = intdiv($this->height, 2);
        }

        // var_dump($this->correlatedMatrix);

        echo "<br>x1";
        var_dump($this->x1);
        echo "y1";
        var_dump($this->y1);

        // echo "<br>ZONA [0]<br>";

        for($i=0; $i < $this->y1; $i++) {
            for($j=0; $j < $this->x1; $j++) {
                $this->amount[0]++;
                // echo "<br>i:";
                // var_dump($i);
                // echo "j:";
                // var_dump($j);                
                // echo "--------------------";
                if($this->correlatedMatrix[$i][$j] == 1) {
                    $this->density[0]++;                   
                }
            }
        }           

        // echo "<br>ZONA [1]<br>";

        for($i= 0; $i <$this->y1 ; $i++) {
            for($j=$this->x1; $j < $this->width; $j++) {
                $this->amount[1]++;    
                // echo "<br>i:";
                // var_dump($i);
                // echo "j:";
                // var_dump($j);                
                // echo "--------------------";
                if($this->correlatedMatrix[$i][$j] == 1) {
                    $this->density[1]++;                    
                }
            }
        }

        // echo "<br>ZONA [2]<br>";

        for($i=$this->y1; $i < $this->height; $i++) {
            for($j=0; $j < $this->x1; $j++) {
                $this->amount[2]++;
                // echo "<br>i:";
                // var_dump($i);
                // echo "j:";
                // var_dump($j);                
                // echo "--------------------";
                if($this->correlatedMatrix[$i][$j] == 1) {
                    $this->density[2]++;
                }
            }
        }        

        // echo "<br>ZONA [3]<br>";

        for($i=$this->y1; $i < $this->height; $i++) {
            for($j=$this->x1; $j < $this->width; $j++) {
                $this->amount[3]++;
                // echo "<br>i:";
                // var_dump($i);
                // echo "j:";
                // var_dump($j);                
                // echo "--------------------";
                if($this->correlatedMatrix[$i][$j] == 1) {
                    $this->density[3]++;
                }
            }            
        }

        // var_dump($this->amount);
        // var_dump($this->density);

        //-------------------------------------

        for($i=0; $i<4; $i++) {
            $this->density2[$i] = ($this->density[$i] / $this->amount[$i]);
            if($this->higher < $this->density2[$i]){
                $this->higher = $this->density2[$i];
            }
        }
        
        // var_dump($this->density2);     

        if($this->higher == $this->density2[0]) {
            // echo "caso density2[0]";
            do {                
                $r1 = rand( 0, ($this->x1 - 1));
                $r2 = rand( 0, ($this->y1 - 1));

                $this->startingPoint = new Point($r1, $r2, 0, '', 0);

            } while($this->correlatedMatrix[$this->startingPoint->getValueX()][$this->startingPoint->getValueY()] == 0);
            // echo "<br>r1:";
            // var_dump($r1);
            // echo "<br>r2:";
            // var_dump($r2);
            // die();
        }

        if($this->higher == $this->density2[1]) {
            // echo "caso density2[1]";
            do {

                $r1 = rand( 0, ($this->x1 - 1));
                $r2 = rand( $this->x1, ($this->width - 1));

                $this->startingPoint = new Point($r1, $r2, 0, '', 0);

            } while($this->correlatedMatrix[$this->startingPoint->getValueX()][$this->startingPoint->getValueY()] == 0);
            // echo "<br>r1:";
            // var_dump($r1);
            // echo "<br>r2:";
            // var_dump($r2);
            // die();
        }

        if($this->higher == $this->density2[2]) {
            // echo "caso density2[2]";
            do {

                $r1 = rand( $this->x1, ($this->height - 1));
                $r2 = rand( 0, ($this->y1 - 1));

                $this->startingPoint = new Point($r1, $r2, 0, '', 0);

            } while($this->correlatedMatrix[$this->startingPoint->getValueX()][$this->startingPoint->getValueY()] == 0);
            // echo "<br>r1:";
            // var_dump($r1);
            // echo "<br>r2:";
            // var_dump($r2);
            // die();
        }

        if($this->higher == $this->density2[3]) {
            // echo "caso density2[3]";
            do {

                $r1 = rand( $this->x1, ($this->height - 1));
                $r2 = rand( $this->x1, ($this->width - 1));

                $this->startingPoint = new Point($r1, $r2, 0, '', 0);

            } while($this->correlatedMatrix[$this->startingPoint->getValueX()][$this->startingPoint->getValueY()] == 0);
            // echo "<br>r1:";
            // var_dump($r1);
            // echo "<br>r2:";
            // var_dump($r2);
            // die();
        }

        // var_dump($this->startingPoint);

        var_dump($this->startingPoint);

        return $this->startingPoint;

    }

}
