<?php

namespace App\Models\EvolutionaryAlgorithm\CoupleFormationTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\CoupleFormation;

class Simplex extends CoupleFormation
{
    use HasFactory;

    public function coupleFormation() {
        try {

            $indexSelected = $this->generation->getIndexSelectedConformations();
            $parents = array();

        } catch (Exception $e) {
            echo "<br> Exception -> message: ".$e->getMessage()."<br>";
        }
    }

}
