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
use App\Models\EvolutionaryAlgorithm\GeneratePointsTypes\GenerateSquarePoints;
use App\Models\EvolutionaryAlgorithm\Point;
use App\Models\EvolutionaryAlgorithm\GeneratePointsTypes\GenerateCubePoints;
use App\Models\EvolutionaryAlgorithm\MutationTypes\Random;
use App\Models\EvolutionaryAlgorithm\Fitness;
use App\Models\EvolutionaryAlgorithm\CoupleFormationTypes\SimplexCoupleFormation;

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

        $conformation1 = new Conformation(null);
        $conformation1->setFitness(-7);
        $conformation2 = new Conformation(null);
        $conformation2->setFitness(-5);
        $conformation3 = new Conformation(null);
        $conformation3->setFitness(-4);
        $conformation4 = new Conformation(null);
        $conformation4->setFitness(-13);
        $conformation5 = new Conformation(null);
        $conformation5->setFitness(-99);
        $conformation6 = new Conformation(null);
        $conformation6->setFitness(-9);

        $arrayConformations = array($conformation1, $conformation2, $conformation3, $conformation4, $conformation5, $conformation6);
        $generation = new Generation($arrayConformations);
        
        $roulette = new Roulette($generation);
        $roulette->execute();

        echo "<br> FITNESS DE LAS CONFORMACIONES OBTENIDAS CON LA RULETA: <br>";
        for($i=0; $i<$generation->getSizeGeneration(); $i++){
            echo "selectedConformation[".$i."] = ".$generation->getSelectedConformations()[$i]->getFitness()." <br>";
        }

    }

    // -------- Probar tournament selection
    public function testTournamentSelection(Request $request){

        $conformation1 = new Conformation(null);
        $conformation1->setFitness(-7);
        $conformation2 = new Conformation(null);
        $conformation2->setFitness(-5);
        $conformation3 = new Conformation(null);
        $conformation3->setFitness(-4);
        $conformation4 = new Conformation(null);
        $conformation4->setFitness(-3);
        $conformation5 = new Conformation(null);
        $conformation5->setFitness(-6);
        $conformation6 = new Conformation(null);
        $conformation6->setFitness(-9);

        $arrayConformations = array($conformation1, $conformation2, $conformation3, $conformation4, $conformation5, $conformation6);
        $generation = new Generation($arrayConformations);

        $tournament = new Tournament($generation, 50);
        $tournament->execute();

        echo "<br> FITNESS DE LAS CONFORMACIONES OBTENIDAS CON EL TORNEO: <br>";
        for($i=0; $i<$generation->getSizeGeneration(); $i++){
            echo "selectedConformation[".$i."] = ".$generation->getSelectedConformations()[$i]->getFitness()." <br>";
        }

    }

    // -------- Probar top percent selection
    public function testTopPercentSelection(Request $request){
        
        $conformation1 = new Conformation(null);
        $conformation1->setFitness(-7);
        $conformation2 = new Conformation(null);
        $conformation2->setFitness(-5);
        $conformation3 = new Conformation(null);
        $conformation3->setFitness(-4);
        $conformation4 = new Conformation(null);
        $conformation4->setFitness(-10);
        $conformation5 = new Conformation(null);
        $conformation5->setFitness(-1);
        $conformation6 = new Conformation(null);
        $conformation6->setFitness(-11);

        $arrayConformations = array($conformation1, $conformation2, $conformation3, $conformation4, $conformation5, $conformation6);

        $generation = new Generation($arrayConformations);

        $topPercent = new TopPercent($generation, 50);
        $topPercent->execute();

        echo "<br> FITNESS DE LAS CONFORMACIONES OBTENIDAS CON TOP PERCENT: <br>";
        for($i=0; $i<$generation->getSizeGeneration(); $i++){
            echo "selectedConformation[".$i."] = ".$generation->getSelectedConformations()[$i]->getFitness()." <br>";
        }
        
    }

    // -------- Probar Population Decimation
    public function testPopulationDecimation(Request $request){
        
        $conformation1 = new Conformation(null);
        $conformation1->setFitness(-7);
        $conformation2 = new Conformation(null);
        $conformation2->setFitness(-5);
        $conformation3 = new Conformation(null);
        $conformation3->setFitness(-4);
        $conformation4 = new Conformation(null);
        $conformation4->setFitness(-10);
        $conformation5 = new Conformation(null);
        $conformation5->setFitness(-1);
        $conformation6 = new Conformation(null);
        $conformation6->setFitness(-11);

        $arrayConformations = array($conformation1, $conformation2, $conformation3, $conformation4, $conformation5, $conformation6);

        $generation = new Generation($arrayConformations);

        $popDecimation = new PopulationDecimation($generation);
        $popDecimation->execute();

        echo "<br> FITNESS DE LAS CONFORMACIONES OBTENIDAS CON POP DECIMATION: <br>";
        for($i=0; $i<$generation->getSizeGeneration(); $i++){
            echo "selectedConformation[".$i."] = ".$generation->getSelectedConformations()[$i]->getFitness()." <br>";
        }

    }

    // -------- Probar Elitismo
    public function testElitism(Request $request) {
        
        $conformation1 = new Conformation(null);
        $conformation1->setFitness(-7);
        $conformation2 = new Conformation(null);
        $conformation2->setFitness(-5);
        $conformation3 = new Conformation(null);
        $conformation3->setFitness(-6);
        $conformation4 = new Conformation(null);
        $conformation4->setFitness(-9);
        $conformation5 = new Conformation(null);
        $conformation5->setFitness(-1);
        $conformation6 = new Conformation(null);
        $conformation6->setFitness(-10);

        $arrayConformations = array($conformation1, $conformation2, $conformation3, $conformation4, $conformation5, $conformation6);

        $generation = new Generation($arrayConformations);

        $percentOfElitism = 40;

        // $selectionOperator = "roulette";
        // $selectionOperator = "tournament";
        // $selectionOperator = "top_percent";
        $selectionOperator = "population_decimation";

        $percentOfSelectionOperator = 40;

        $elitism = new Elitism($percentOfElitism, $generation, $selectionOperator, $percentOfSelectionOperator);
        $elitism->execute();

        // echo "<br> FITNESS DE LAS CONFORMACIONES OBTENIDAS CON ELITISMO: <br>";
        // for($i=0; $i<$generation->getSizeGeneration(); $i++){
        //     echo "selectedConformation[".$i."] = ".$generation->getSelectedConformations()[$i]->getFitness()." <br>";
        // }

    }

    // -------- Probar couple formation SIMPLEX
    public function testCoupleFormationSimplex(){

        $conformation1 = new Conformation(null);
        $conformation1->setFitness(-7);
        $conformation2 = new Conformation(null);
        $conformation2->setFitness(-5);
        $conformation3 = new Conformation(null);
        $conformation3->setFitness(-4);
        $conformation4 = new Conformation(null);
        $conformation4->setFitness(-13);
        $conformation5 = new Conformation(null);
        $conformation5->setFitness(-99);
        $conformation6 = new Conformation(null);
        $conformation6->setFitness(-9);

        $arrayConformations = array($conformation1, $conformation2, $conformation3, $conformation4, $conformation5, $conformation6);
        $generation = new Generation($arrayConformations);
        
        $roulette = new Roulette($generation);
        $roulette->execute();

        echo "<br> FITNESS DE LAS CONFORMACIONES OBTENIDAS CON LA RULETA: <br>";
        for($i=0; $i<$generation->getSizeGeneration(); $i++){
            echo "selectedConformation[".$i."] = ".$generation->getSelectedConformations()[$i]->getFitness()." indexposition: ".$generation->getSelectedConformations()[$i]->getPositionIndex()." <br>";
        }

        // $conformation1 = new Conformation(null);
        // $conformation1->setFitness(-7);
        // $conformation2 = new Conformation(null);
        // $conformation2->setFitness(-5);
        // $conformation3 = new Conformation(null);
        // $conformation3->setFitness(-4);
        // $conformation4 = new Conformation(null);
        // $conformation4->setFitness(-10);
        // $conformation5 = new Conformation(null);
        // $conformation5->setFitness(-1);
        // $conformation6 = new Conformation(null);
        // $conformation6->setFitness(-11);

        // $arrayConformations = array($conformation1, $conformation2, $conformation3, $conformation4, $conformation5, $conformation6);

        // $generation = new Generation($arrayConformations);

        // $popDecimation = new PopulationDecimation($generation);
        // $popDecimation->execute();

        // echo "<br> FITNESS DE LAS CONFORMACIONES OBTENIDAS CON POP DECIMATION: <br>";
        // for($i=0; $i<$generation->getSizeGeneration(); $i++){
        //     echo "selectedConformation[".$i."] = ".$generation->getSelectedConformations()[$i]->getFitness()." indexposition: ".$generation->getSelectedConformations()[$i]->getPositionIndex()." <br>";
        // }

        $simplex = new SimplexCoupleFormation($generation);
        $simplex->coupleFormation();

        $i=0;
        foreach($generation->getParentsList() as $parent){
            echo "<br> ----- Somos los padres ".$i." -----<br>";
            echo "padre 1 (indice): ".$parent->getParent1()."<br>";
            echo "padre 2 (indice): ".$parent->getParent2()."<br>";
            $i++;
        }

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

    public function testRandomMutation(Request $request) {
        $json = $request->input('json', null);
        $params = json_decode($json);

        if(is_object($params)) {
            $dimension_type = $params->dimension_type;
            $mutation_probability = $params->mutation_probability;

            $conformation = new Conformation(-59);

            for($i=0; $i<100; $i++) {
                $random = new Random($mutation_probability, $dimension_type);
                $random->execute($conformation);
            }
            
            die();
        } else {
            $data = array(
                'code' => 404,
                'status' => 'error',
                'message' => "Data dosn't sending"
            );
        }

        return response()->json($data, $data['code']);
    }

    public function testFitness(Request $request) {
        $json = $request->input('json', null);
        $params = json_decode($json);

        if(is_object($params)) {
            //$points = array(new Point(1, 0, null, 'H', 0), new Point(0, 0, null, 'H', 0), new Point(1, 1, null, 'H', 1));
            $points = array(new Point(1, 0, null, 'P', 0), new Point(0, 0, null, 'H', 0), new Point(1, 1, null, 'P', 1));
            
            $dimension = $params->dimension_type;
            $function = $params->function_type;

            $fitness = new Fitness($points, $dimension, $function);
            $fts = $fitness->getFitness();
            echo $fts;
            die();
        } else {
            $data = array(
                'code' => 404,
                'Status' => 'error',
                'message' => "Data dosn't sending"
            );
        }

        return response()->json($data, $data['code']);
    }

}
