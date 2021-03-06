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
    private $way0 = true;
    private $way1 = true;
    private $way2 = true;
    private $way3 = true;
    private $way4 = true;
    private $way5 = true;

    public function __construct($xValue, $yValue, $zValue, $letter, $movVectorValue) {
        $this->xValue = $xValue;
        $this->yValue = $yValue;
        $this->zValue = $zValue;
        $this->letter = $letter;
        $this->movVectorValue = $movVectorValue;
    }

    public function getValueX() {
        return $this->xValue;
    }

    public function setValueX($x){
        $this->xValue = $x;
    }

    public function getValueY() {
        return $this->yValue;
    }

    public function setValueY($y){
        $this->yValue = $y;
    }

    public function getValueZ() {
        return $this->zValue;
    }

    public function setValueZ($z){
        $this->zValue = $z;
    }

    public function getLetter() {
        return $this->letter;
    }

    public function getMovVectorValue() {
        return $this->movVectorValue;
    }

    public function setMovVectorValue($movVectorValue) {
        $this->movVectorValue = $movVectorValue;
    }

    public function isWay0(){
        return $this->way0;
    }

    public function setWay0($way0){
        $this->way0 = $way0;
    }

    public function isWay1(){
        return $this->way1;
    }

    public function setWay1($way1){
        $this->way1 = $way1;
    }

    public function isWay2(){
        return $this->way2;
    }

    public function setWay2($way2){
        $this->way2 = $way2;
    }

    public function isWay3(){
        return $this->way3;
    }

    public function setWay3($way3){
        $this->way3 = $way3;
    }

    public function isWay4(){
        return $this->way4;
    }

    public function setWay4($way4){
        $this->way4 = $way4;
    }

    public function isWay5(){
        return $this->way5;
    }

    public function setWay5($way5){
        $this->way5 = $way5;
    }

    public function resetR(){
        $this->way0 = true;
        $this->way1 = true;
        $this->way2 = true;
        $this->way3 = true;
        $this->way4 = true;
        $this->way5 = true;
    }

}
