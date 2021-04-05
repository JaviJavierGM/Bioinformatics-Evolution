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
    // points
    private $upperLeft;
    private $upperRight;
    private $lowerLeft;
    private $lowerRight;
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

    public function __construct($fileName, $upperLeft, $upperRight, $lowerLeft, $lowerRight){
        $this->fileName = $fileName;
        $this->upperLeft = $upperLeft;
        $this->upperRight = $upperRight;
        $this->lowerLeft = $lowerLeft;
        $this->lowerRight = $lowerRight;

    }

    public function getCorrelatedMatrix() {
        return $this->correlatedMatrix;
    }

    public function setCorrelatedMatrix($correlatedMatrix){
        $this->correlatedMatrix = $correlatedMatrix;
    }

    public function getStartingPoint() {
        return $this->startingPoint;
    }

    public function readMatrix() {  
        
        $stringFileName = "correlatedNetworks/cp".$this->fileName[3].$this->fileName[4].'.txt';
        // var_dump($stringFileName); die();

        // var_dump($stringFileName);
        // var_dump($this->upperLeft);
        // var_dump($this->upperRight);
        // var_dump($this->lowerLeft);
        // var_dump($this->lowerRight);
        
        $contents = Storage::get($stringFileName);

        $contents .= "\n";

        $arrayTemp = array();
        $matrix = array();
        
        // Leer la matriz del archivo txt
        for($i=0; $i<strlen($contents); $i++){            

            if($contents[$i] == "\n"){
                array_push($matrix, $arrayTemp);
                unset($arrayTemp);                
                if(!isset($arrayTemp))
                    $arrayTemp = array();
            }else{                
                if($contents[$i] == "0" || $contents[$i] == "1"){
                    array_push($arrayTemp, (int)$contents[$i]);
                }                            
            }
            
        }        

        // Copiar solo la parte seleccionada
        unset($arrayTemp);
        $arrayTemp = array();

        $verticalSide = (int)sqrt( pow( $this->lowerLeft->getValueX()-$this->upperLeft->getValueX() ,2) + pow( $this->lowerLeft->getValueY()-$this->upperLeft->getValueY() ,2)) +1;
        $horizontalSide  = (int)sqrt( pow( $this->upperRight->getValueX()-$this->upperLeft->getValueX() ,2) + pow( $this->upperRight->getValueY()-$this->upperLeft->getValueY() ,2)) +1;

        for($i=$this->upperLeft->getValueX(); $i<$this->upperLeft->getValueX()+$verticalSide; $i++){

            if(!isset($arrayTemp))
                $arrayTemp = array();

            for($j=$this->upperLeft->getValueY(); $j<$this->upperLeft->getValueY()+$horizontalSide; $j++){
                array_push($arrayTemp, $matrix[$i][$j]);
            }

            array_push($this->correlatedMatrix, $arrayTemp);
            unset($arrayTemp);

        }

        $this->width = sizeof($this->correlatedMatrix[0]);
        $this->height = sizeof($this->correlatedMatrix);

        // for($i=0; $i<$this->height; $i++){
        //     for($j=0; $j<$this->width; $j++){
        //         echo $this->correlatedMatrix[$i][$j];
        //     }
        //     echo "<br>";
        // }

        // die();

        unset($contents, $arrayTemp, $matrix);

    }

    public function generateStartingPoint() {

        $this->width = sizeof($this->correlatedMatrix[0]);
        $this->height = sizeof($this->correlatedMatrix);
        
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

        for($i=0; $i < $this->y1; $i++) {
            for($j=0; $j < $this->x1; $j++) {
                $this->amount[0]++;
                if($this->correlatedMatrix[$i][$j] == 1) {
                    $this->density[0]++;                   
                }
            }
        }           

        for($i= 0; $i <$this->y1 ; $i++) {
            for($j=$this->x1; $j < $this->width; $j++) {
                $this->amount[1]++;    
                if($this->correlatedMatrix[$i][$j] == 1) {
                    $this->density[1]++;                    
                }
            }
        }

        for($i=$this->y1; $i < $this->height; $i++) {
            for($j=0; $j < $this->x1; $j++) {
                $this->amount[2]++;
                if($this->correlatedMatrix[$i][$j] == 1) {
                    $this->density[2]++;
                }
            }
        }        

        for($i=$this->y1; $i < $this->height; $i++) {
            for($j=$this->x1; $j < $this->width; $j++) {
                $this->amount[3]++;
                if($this->correlatedMatrix[$i][$j] == 1) {
                    $this->density[3]++;
                }
            }            
        }

        for($i=0; $i<4; $i++) {
            $this->density2[$i] = ($this->density[$i] / $this->amount[$i]);
            if($this->higher < $this->density2[$i]){
                $this->higher = $this->density2[$i];
            }
        }

        // var_dump($this->higher);
        // var_dump($this->density);
        // var_dump($this->density2);
        // die();

        if($this->higher == $this->density2[0]) {
            do {                
                $r1 = rand( 0, ($this->y1 - 1));
                $r2 = rand( 0, ($this->x1 - 1));

                $this->startingPoint = new Point($r1, $r2, 0, '', 0);

            } while($this->correlatedMatrix[$this->startingPoint->getValueX()][$this->startingPoint->getValueY()] == 0);                        
        }

        if($this->higher == $this->density2[1]) {
            do {

                $r1 = rand( 0, ($this->y1 - 1));
                $r2 = rand( $this->x1, ($this->width - 1));

                $this->startingPoint = new Point($r1, $r2, 0, '', 0);

            } while($this->correlatedMatrix[$this->startingPoint->getValueX()][$this->startingPoint->getValueY()] == 0);
        }

        if($this->higher == $this->density2[2]) {
            do {

                $r1 = rand( $this->y1, ($this->height - 1));
                $r2 = rand( 0, ($this->x1 - 1));

                $this->startingPoint = new Point($r1, $r2, 0, '', 0);

            } while($this->correlatedMatrix[$this->startingPoint->getValueX()][$this->startingPoint->getValueY()] == 0);
        }

        if($this->higher == $this->density2[3]) {
            do {

                $r1 = rand( $this->y1, ($this->height - 1));
                $r2 = rand( $this->x1, ($this->width - 1));

                $this->startingPoint = new Point($r1, $r2, 0, '', 0);

            } while($this->correlatedMatrix[$this->startingPoint->getValueX()][$this->startingPoint->getValueY()] == 0);
        }

        // var_dump($this->startingPoint);

        return $this->startingPoint;

    }

}
