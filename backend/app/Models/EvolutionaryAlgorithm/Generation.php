<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\Conformation;

class Generation extends Model
{
    use HasFactory;

    private $conformations = array();
    private $sizeGeneration;
    private $indexSelectedConformations = array();
    private $parentsList = array();
    // private $radioGiroP; // --> PENDIENTE QUE ES ESTE ATRIBUTO
    // private $DmaxP; // --> PENDIENTE QUE ES ESTE ATRIBUTO

    public function __construct($conformations) {
        $this->conformations = $conformations;
        $this->sizeGeneration = sizeof($this->conformations);

        // Llena el atributo positionIndex de las conformaciones
        $i=0;
        foreach($this->conformations as $conformation){
            $conformation->setPositionIndex($i);
            $i++;
        }        
    }

    public function getCloneGeneration() {
        // Nos devuelve la misma generacion, pero clonada,
        // para evitar problemas de referencia
        $copyConformations = array();

        foreach($this->conformations as $conformation){
            $temp = new Conformation($conformation->getPoints());
            $temp->setFitness($conformation->getFitness());
            array_push($copyConformations, $temp);
        }

        $cloneGeneration = new Generation($copyConformations);
        return $cloneGeneration;
    }

    public function getConformations() {
        return $this->conformations;
    }

    public function setConformations($conformations) {
        $this->conformations = $conformations;
    }

    public function getTotalFitness(){
        // Nos regresa el fitness total de toda la generacion,
        // pero con signo NEGATIVO
        $totalFitness=0;
        foreach($this->conformations as $conformation) {
            $totalFitness+= $conformation->getFitness();
        }
        return $totalFitness;
    }

    public function getSizeGeneration() {
        return $this->sizeGeneration;
    }

    public function getOrderedConformations($order) {
        // Nos regresa una copia de las conformaciones ordenadas

        $orderedConformations  = $this->conformations;
        // Si order == true ordena en forma ascendente
        if($order == true){
            rsort($orderedConformations);
        }else{
            // order == false ordena en forma descendente
            sort($orderedConformations);
        }

        return $orderedConformations;
    }

    public function getIndexSelectedConformations() {
        return $this->indexSelectedConformations;
    }

    public function setIndexSelectedConformations($arrayIndex) {
        $this->indexSelectedConformations = $arrayIndex;
    }

    public function getSelectedConformations() {
        $size = sizeof($this->indexSelectedConformations);
        $conformationsSelected = array();
        for($i=0; $i<$size; $i++){
            array_push($conformationsSelected, $this->conformations[$this->indexSelectedConformations[$i]]);
        }

        return $conformationsSelected;
    }

    public function getParentsList() {
        return $this->parentsList;
    }

    public function setParentsList($parentsList) {
        $this->parentsList = $parentsList;
    }

    public function convertToJson() {
        $generation = array(
            'totalFitnessGeneration' => $this->getTotalFitness()
        );
        $conformations = array();        
        foreach ($this->conformations as $conformation) {
            $conformation_json = array(
                'fitness' => $conformation->getFitness(),
                'points' => $conformation->getPointsJson()
            );

            array_push($conformations, $conformation_json);
        }

        array_push($generation, $conformations);

        return $generation;
    }
}
