<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvolutionaryAlgorithm\CrossoverTypes\OnePoint;
use App\Models\EvolutionaryAlgorithm\CrossoverTypes\TwoPoints;
use App\Models\EvolutionaryAlgorithm\CrossoverTypes\Uniform;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\Roulette;
use App\Models\EvolutionaryAlgorithm\Generation;
use App\Models\EvolutionaryAlgorithm\Conformation;

class EvolutionaryAlgorithmController extends Controller
{
    public function tests(Request $request) {
        return "Accion de pruebas de EVOLUTIONARY-ALGORITHM-CONTROLLER";
    }

    public function testOnePointCrossover(Request $request) {
        $json = $request->input('json', null);
        $params = json_decode($json);

        $params->parent_one = explode(',', $params->parent_one);
        $params->parent_two = explode(',', $params->parent_two);

        $onePointCrossover = new Uniform($params->parent_one, $params->parent_two, $params->crossover_probability);
        $lengthHpString = sizeof($params->parent_one);
        $onePointCrossover->execute($lengthHpString);

        $child_one = $onePointCrossover->getChildrenOne();
        $child_two = $onePointCrossover->getChildrenTwo();

        echo '<br/>';

        echo 'Parent One:  ';
        echo '[ ';
        for ($i=0; $i < sizeof($params->parent_one) ; $i++) {
            echo  $params->parent_one[$i].' ';
        }
        echo ']';

        echo '<br/>';

        echo 'Parent Two:  ';
        echo '[ ';
        for ($i=0; $i < sizeof($params->parent_two) ; $i++) { 
            echo  $params->parent_two[$i].' ';
        }
        echo ']';

        echo '<br/>';
        echo '<br/>';

        echo 'Children One:  ';
        echo '[ ';
        for ($i=0; $i < sizeof($child_one) ; $i++) { 
            echo $child_one[$i].' ';
        }
        echo ']';

        echo '<br>';

        echo 'Children Two: ';
        echo '[ ';
        for ($i=0; $i < sizeof($child_two) ; $i++) { 
            echo $child_two[$i].' ';
        }
        echo ']';
        die();
    }

    // -------- Probar la ruleta
    public function testRouletteSelection(Request $request){

        $generation = new Generation();

        $conformation1 = new Conformation();
        $conformation1->setFitness(-7);
        $conformation2 = new Conformation();
        $conformation2->setFitness(-1);
        $conformation3 = new Conformation();
        $conformation3->setFitness(-3);

        $arrayConformations = array($conformation1, $conformation2, $conformation3);

        $generation->setConformations($arrayConformations);
        
        $roulette = new Roulette($generation);

        $roulette->execute();
        // die();
    }
}
