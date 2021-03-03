<?php

namespace App\Models\EvolutionaryAlgorithm\CoupleFormationTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\CoupleFormation;
use App\Models\EvolutionaryAlgorithm\Parents;

class SimplexCoupleFormation extends CoupleFormation
{
    use HasFactory;

    public function __construct($generation) {
        $this->generation = $generation;
    }

    public function coupleFormation() {
        try {
            $indexSelected = $this->generation->getIndexSelectedConformations();
            $parents = array();
            $part2 = array();
            $halfSize = round( (sizeof($indexSelected) / 2), null, PHP_ROUND_HALF_DOWN);;            

            for($i=0; $i < $halfSize; $i++) {                
                array_push($parents, new Parents());
                $parents[$i]->setParent1( $indexSelected[$i] );
                array_push($part2, $indexSelected[$i + $halfSize]);
            }

            for($i=0; $i < $halfSize; $i++) {
                $parentTemp = new Parents();
                $parentTemp->setParent1( $parents[$i]->getParent1() );
                $posRandom = rand(0, sizeof($part2)-1);
                $parentTemp->setParent2( $part2[$posRandom] );

                $flag=true;
                foreach($parents as $parent) {
                    if( $parent->getParent1() == $parentTemp->getParent1() && $parent->getParent2() == $parentTemp->getParent2() ) {
                        if( sizeof($part2) == 1 ) {
                            $flag = true;
                            break;
                        } else {
                            $i--;
                            $flag = false;
                            break;
                        }
                    }
                }

                if( $flag ) {
                    $parents[$i]->setParent2( $part2[$posRandom] );
                    unset($part2[$posRandom]);
                    $part2 = array_values($part2);
                }
                
            }            
            
            $this->generation->setParentsList($parents);

        } catch (Exception $e) {
            echo "<br> Exception -> message: ".$e->getMessage()."<br>";
        }
    }

}
