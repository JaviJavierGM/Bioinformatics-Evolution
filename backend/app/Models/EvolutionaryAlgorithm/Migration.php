<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Migration extends Model
{
    use HasFactory;
    
    private $generation;
    private $conformation;
    private $newGeneration;

    public function __construct($generation, $conformation, $newGeneration) {
        $this->generation = $generation;
        $this->conformation = $conformation;
        $this->newGeneration = $newGeneration;
    }

    public function execute() {
        if(sizeof($conformation) > 0) {
            $newConformation = array();

            for ($i=0; $i < sizeof($conformation); $i++) { 
                //array_push($conformation, $generation->getConformations())
            }
        }
    }
}
