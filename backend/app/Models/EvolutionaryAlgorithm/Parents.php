<?php

namespace App\Models\EvolutionaryAlgorithm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;

    private $parent1;
    private $parent2;

    public function __construct(){
        
    }

    public function getParent1() {
        return $this->parent1;
    }

    public function setParent1($parent1) {
        $this->parent1 = $parent1;
    }

    public function getParent2() {
        return $this->parent2;
    }

    public function setParent2($parent2) {
        $this->parent2 = $parent2;
    }
    
}
