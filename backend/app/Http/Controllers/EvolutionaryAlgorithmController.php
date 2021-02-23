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
use App\Models\EvolutionaryAlgorithm\SelectionTypes\PopulationDecimation;
use App\Models\EvolutionaryAlgorithm\OtherGeneticTechniques\Elitism;
<<<<<<< HEAD
use App\Models\EvolutionaryAlgorithm\GeneratePointsTypes\GenerateSquarePoints;

use App\Models\EvolutionaryAlgorithm\Point;
=======
use App\Models\EvolutionaryAlgorithm\GeneratePointsTypes\GenerateCubePoints;
>>>>>>> 341ee176b6e856b1df13c68f647ad29d6abfa6c7

class EvolutionaryAlgorithmController extends Controller
{
    public function tests(Request $request) {
        return "Accion de pruebas de EVOLUTIONARY-ALGORITHM-CONTROLLER";
    }

    public function testUniformCrossover(Request $request) {
        $json = $request->input('json', null);
        $params = json_decode($json);

        if (is_object($params)) {
            $params->parent_one = explode(',', $params->parent_one);
            $params->parent_two = explode(',', $params->parent_two);

            $uniformCrossover = new Uniform($params->parent_one, $params->parent_two, $params->crossover_probability);
            $lengthHpString = sizeof($params->parent_one);
            $uniformCrossover->execute($lengthHpString);
                
            $child_one = $uniformCrossover->getChildrenOne();
            $child_two = $uniformCrossover->getChildrenTwo();
            die();
            $data = array(
                'code' => 200,
                'status' => 'success',
                'parent_one' => $params->parent_one,
                'parent_two' => $params->parent_two,
                'children_one' => $child_one,
                'children_two' => $child_two
            );
            

        } else {
            $data = array(
                'code' => 400,
                'status' => 'error',
                'message' => 'Data not sending!'
            );
        }
        return response()->json($data, $data['code']);
    }

    public function testOnePointCrossover(Request $request) {
        $json = $request->input('json', null);
        $params = json_decode($json);

        if (is_object($params)) {
            $params->parent_one = explode(',', $params->parent_one);
            $params->parent_two = explode(',', $params->parent_two);

            $uniformCrossover = new OnePoint($params->parent_one, $params->parent_two, $params->crossover_probability);
            $lengthHpString = sizeof($params->parent_one);
            $uniformCrossover->execute($lengthHpString);
                
            $child_one = $uniformCrossover->getChildrenOne();
            $child_two = $uniformCrossover->getChildrenTwo();
            die();
            $data = array(
                'code' => 200,
                'status' => 'success',
                'parent_one' => $params->parent_one,
                'parent_two' => $params->parent_two,
                'children_one' => $child_one,
                'children_two' => $child_two
            );
            

        } else {
            $data = array(
                'code' => 400,
                'status' => 'error',
                'message' => 'Data not sending!'
            );
        }
        return response()->json($data, $data['code']);
    }

    public function testTwoPointsCrossover(Request $request) {
        $json = $request->input('json', null);
        $params = json_decode($json);

        if (is_object($params)) {
            $params->parent_one = explode(',', $params->parent_one);
            $params->parent_two = explode(',', $params->parent_two);

            $uniformCrossover = new TwoPoints($params->parent_one, $params->parent_two, $params->crossover_probability);
            $lengthHpString = sizeof($params->parent_one);
            $uniformCrossover->execute($lengthHpString);
                
            $child_one = $uniformCrossover->getChildrenOne();
            $child_two = $uniformCrossover->getChildrenTwo();
            die();
            $data = array(
                'code' => 200,
                'status' => 'success',
                'parent_one' => $params->parent_one,
                'parent_two' => $params->parent_two,
                'children_one' => $child_one,
                'children_two' => $child_two
            );
            

        } else {
            $data = array(
                'code' => 400,
                'status' => 'error',
                'message' => 'Data not sending!'
            );
        }
        return response()->json($data, $data['code']);
    }

    // -------- Probar la ruleta
    public function testRouletteSelection(Request $request){

        $conformation1 = new Conformation(-7);
        $conformation2 = new Conformation(-5);
        $conformation3 = new Conformation(-1);
        $conformation4 = new Conformation(-13);
        $conformation5 = new Conformation(-99);

        $arrayConformations = array($conformation1, $conformation2, $conformation3, $conformation4, $conformation5);
        $generation = new Generation($arrayConformations);
        
        $roulette = new Roulette($generation);
        $roulette->execute();

        echo "<br> FITNESS DE LAS CONFORMACIONES OBTENIDAS CON LA RULETA: <br>";
        foreach($roulette->getSelectedConformations() as $conformation){
            var_dump($conformation->getFitness());
        }

        echo "termino RULETA";
        die();
    }

    // -------- Probar tournament selection
    public function testTournamentSelection(Request $request){

        $conformation1 = new Conformation(-7);
        $conformation2 = new Conformation(-5);
        $conformation3 = new Conformation(-1);
        $conformation4 = new Conformation(-3);
        $conformation5 = new Conformation(-6);

        $arrayConformations = array($conformation1, $conformation2, $conformation3, $conformation4, $conformation5);
        $generation = new Generation($arrayConformations);

        $tournament = new Tournament($generation, 50);
         $tournament->execute();

    }

    // -------- Probar top percent selection
    public function testTopPercentSelection(Request $request){
        $conformation1 = new Conformation(-7);
        $conformation2 = new Conformation(-5);
        $conformation3 = new Conformation(-0.2551544);
        $conformation4 = new Conformation(-99);
        $conformation5 = new Conformation(-1);
        $conformation6 = new Conformation(-15);

        $arrayConformations = array($conformation1, $conformation2, $conformation3, $conformation4, $conformation5, $conformation6);

        $generation = new Generation($arrayConformations);

        $topPercent = new TopPercent($generation, 30);
        $topPercent->execute();
    }

    // -------- Probar Population Decimation
    public function testPopulationDecimation(Request $request){
        $conformation1 = new Conformation(-7);
        $conformation2 = new Conformation(-5);
        $conformation3 = new Conformation(-0.2551544);
        $conformation4 = new Conformation(-99);
        $conformation5 = new Conformation(-1);
        $conformation6 = new Conformation(-15);

        $arrayConformations = array($conformation1, $conformation2, $conformation3, $conformation4, $conformation5, $conformation6);

        $generation = new Generation($arrayConformations);

        $popDecimation = new PopulationDecimation($generation);
        $popDecimation->execute();
    }

    // -------- Probar Elitismo
    public function testElitism(Request $request) {
        $conformation1 = new Conformation(-7);
        $conformation2 = new Conformation(-5);
        $conformation3 = new Conformation(-6);
        $conformation4 = new Conformation(-9);
        $conformation5 = new Conformation(-1);
        $conformation6 = new Conformation(-10);

        $arrayConformations = array($conformation1, $conformation2, $conformation3, $conformation4, $conformation5, $conformation6);

        $generation = new Generation($arrayConformations);

        $percentOfElitism = 50;

        // $selectionOperator = "roulette";
        // $selectionOperator = "tournament";
        $selectionOperator = "top_percent";
        // $selectionOperator = "population_decimation";

        $percentOfSelectionOperator = 40;

        $elitism = new Elitism($percentOfElitism, $generation, $selectionOperator, $percentOfSelectionOperator);
        $elitism->execute();

        die();

    }

    // -------- Generate Square Points
    public function testGenerateSquarePoints(){
        $generateSquarePoints = new GenerateSquarePoints();
        $previousPoint = new Point(10, 5, 0, 0, "h");

        // $generateSquarePoints->generateSquarePoint(3, "LETRAXD", $previousPoint);

        $generateSquarePoints->doPoints(null, 1);
    }
    
    public function testGenPoint() {
    $hpString = 'HHHHH';

    $generate = new GenerateCubePoints($hpString, 'correlated', 2);
    $generate->initializeGeneration(6);
    die();

    }

}
