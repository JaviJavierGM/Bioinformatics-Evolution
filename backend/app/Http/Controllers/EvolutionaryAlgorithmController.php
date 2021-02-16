<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvolutionaryAlgorithm\CrossoverTypes\OnePoint;
use App\Models\EvolutionaryAlgorithm\CrossoverTypes\TwoPoints;
use App\Models\EvolutionaryAlgorithm\CrossoverTypes\Uniform;
use App\Models\EvolutionaryAlgorithm\Generation;
use App\Models\EvolutionaryAlgorithm\Conformation;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\Roulette;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\Tournament;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\TopPercent;

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

        $conformation1 = new Conformation(-7);
        // $conformation1->setFitness(-7);
        $conformation2 = new Conformation(-5);
        // $conformation2->setFitness(-1);
        $conformation3 = new Conformation(-1);
        // $conformation3->setFitness(-3);
        $conformation4 = new Conformation(-3);
        // $conformation4->setFitness(-9);
        $conformation5 = new Conformation(-6);
        // $conformation5->setFitness(-23);

        $arrayConformations = array($conformation1, $conformation2, $conformation3, $conformation4, $conformation5);

        // $generation->setConformations($arrayConformations);
        $generation = new Generation($arrayConformations);
        
        
        $roulette = new Roulette($generation);

        $roulette->execute();

        foreach($roulette->getSelectedConformations() as $conformation){
            var_dump($conformation->getFitness());
        }

        echo "termino RULETA";
        die();
    }

    // -------- Probar tournament selection
    public function testTournamentSelection(Request $request){

        $conformation1 = new Conformation(-7);
        // $conformation1->setFitness(-7);
        $conformation2 = new Conformation(-5);
        // $conformation2->setFitness(-1);
        $conformation3 = new Conformation(-1);
        // $conformation3->setFitness(-3);
        $conformation4 = new Conformation(-3);
        // $conformation4->setFitness(-9);
        $conformation5 = new Conformation(-6);
        // $conformation5->setFitness(-23);

        $arrayConformations = array($conformation1, $conformation2, $conformation3, $conformation4, $conformation5);

        // $generation->setConformations($arrayConformations);
        $generation = new Generation($arrayConformations);

        $tournament = new Tournament($generation, 90);

        $tournament->execute();

    }

    // -------- Probar top percent selection
    public function testTopPercentSelection(Request $request){
        $conformation1 = new Conformation(-7);
        $conformation2 = new Conformation(-5);
        $conformation3 = new Conformation(-0.2551544);
        $conformation4 = new Conformation(-99);
        $conformation5 = new Conformation(-1);

        $arrayConformations = array($conformation1, $conformation2, $conformation3, $conformation4, $conformation5);

        $generation = new Generation($arrayConformations);

        $topPercent = new TopPercent($generation, 90);
        $topPercent->execute();
    }
}
