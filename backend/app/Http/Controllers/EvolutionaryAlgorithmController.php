<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helpers;
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
use App\Models\EvolutionaryAlgorithm\GeneratePointsTypes\GenerateTrianglePoints;
use App\Models\EvolutionaryAlgorithm\CorrelatedNetwork;
use App\Models\EvolutionaryAlgorithm\Parents;
use App\Models\EvolutionaryAlgorithm\MutationTypes\Predefined;

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
        $pointsParentOne = array(
            new Point(1, 0, null, 'P', 0),
            new Point(1, 2, null, 'P', 0),
            new Point(0, 0, null, 'H', 0), 
            new Point(1, 0, null, 'H', 2),
            new Point(1, 0, null, 'H', 2),
            new Point(1, 1, null, 'P', 1)
        );

        $pointsParentTwo = array(
            new Point(1.5, 0, null, 'P', 1),                
            new Point(1, 0, null, 'H', 0),
            new Point(0, 0, null, 'H', 0),
            new Point(2.5, 0, null, 'P', 4),
            new Point(0.5, 0, null, 'H', 0),
            new Point(0, 1, null, 'H', 2)
        );

        $newChildrenOne = array();
        $newChildrenTwo = array();
        $pointsChildren_C = array();

        $hpString = 'HPPPHH';
        $crossover = new OnePoint(null, 'homogeneus', '2D_Square', strlen($hpString), 5, 1.0, null, $hpString);
        $childrens = $crossover->execute($pointsParentOne, $pointsParentTwo, $newChildrenOne, $newChildrenTwo, $pointsChildren_C);
        var_dump($childrens); die();
    }

    public function testTwoPointsCrossover(Request $request) {
        $pointsParentOne = array(
            new Point(1, 0, null, 'P', 0),
            new Point(1, 2, null, 'P', 0),
            new Point(0, 0, null, 'H', 0), 
            new Point(1, 0, null, 'H', 2),
            new Point(1, 0, null, 'H', 2),
            new Point(1, 1, null, 'P', 1)
        );

        $pointsParentTwo = array(
            new Point(1.5, 0, null, 'P', 1),                
            new Point(1, 0, null, 'H', 0),
            new Point(0, 0, null, 'H', 0),
            new Point(2.5, 0, null, 'P', 4),
            new Point(0.5, 0, null, 'H', 0),
            new Point(0, 1, null, 'H', 2)
        );

        $newChildrenOne = array();
        $newChildrenTwo = array();
        $pointsChildren_C = array();

        $hpString = 'HPPPHH';
        $crossover = new TwoPoints(null, 'homogeneus', '2D_Square', strlen($hpString), 5, 1.0, null, $hpString);
        $childrens = $crossover->execute($pointsParentOne, $pointsParentTwo, $newChildrenOne, $newChildrenTwo, $pointsChildren_C);
        //var_dump($childrens); die();
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
        $selectionOperator = "top_percent";
        // $selectionOperator = "population_decimation";

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
        // parametros de constructor point:
        // $xValue, $yValue, $zValue, $letter, $movVectorValue
        
        // $hpString, $typeSpace, $correlatedMatrix
        $hpString = "HPHP";
        $typeSpace = "correlated";
        // $typeSpace = "homogeneous";
        $correlatedMatrix = array ();

        for($i=0; $i<4; $i++){
            array_push($correlatedMatrix, array(0,0,1));
            print_r($correlatedMatrix[$i]);
            echo "<br>";
        }

        echo "<br>";

        // $correlatedMatrix[2][0]=1;

        for($i=0; $i<4; $i++){
            for($j=0; $j<3; $j++){
                echo $correlatedMatrix[$i][$j]." ";
            }
            echo "<br>";
        }

        $generateSquarePoints = new GenerateSquarePoints($hpString, $typeSpace, $correlatedMatrix, null, null, null);
        //public function __construct($hpString, $typeSpace, $correlatedMatrix, $dimension_type, $function_type, $alphaValue) {
        $generateSquarePoints->initializeGeneration(1);

    }

    // -------- Generate Triangle Points
    public function testGenerateTrianglePoints() { 
        echo "test Generate triangle points <br>";

        $hpString = "HPHP";
        // $typeSpace = "correlated";
        $typeSpace = "homogeneous";
        $correlatedMatrix = array ();

        $generateTrianglePoints = new GenerateTrianglePoints($hpString, $typeSpace, $correlatedMatrix, null, null, null);
        $generateTrianglePoints->initializeGeneration(1);

    }

    // -------- Generate Cube Points
    public function testGenerateCubePoints() { 
        echo "test Generate triangle points <br>";

        $hpString = "HPHPHPHPHPHPHPHPHPHHP";
        // $typeSpace = "correlated";
        $typeSpace = "homogeneous";
        $correlatedMatrix = array ();

        $generateTrianglePoints = new GenerateCubePoints($hpString, $typeSpace, $correlatedMatrix, null, null, null);
        $generateTrianglePoints->initializeGeneration(1);

    }

    // -------- Test Read Matrix
    public function testReadMatrix() { 
        // $xValue, $yValue, $zValue, $letter, $movVectorValue
        
        // Seccion roja
        // $point1 = new Point(0 , 0, null, null, null);
        // $point2 = new Point(3 , 0, null, null, null);
        // $point3 = new Point(0 , 2, null, null, null);
        // $point4 = new Point(3 , 2, null, null, null);

        // Seccion azul
        // $point1 = new Point(1 , 2, null, null, null);
        // $point2 = new Point(3 , 2, null, null, null);
        // $point3 = new Point(1 , 3, null, null, null);
        // $point4 = new Point(3 , 3, null, null, null);

        // Nueva seccion
        $point1 = new Point(0 , 0, null, null, null);
        $point2 = new Point(700 , 0, null, null, null);
        $point3 = new Point(0 , 700, null, null, null);
        $point4 = new Point(700 , 700, null, null, null);

        $correlatedNetwork = new CorrelatedNetwork(null, $point1, $point2, $point3, $point4);

        $correlatedNetwork->readMatrix();

    }

    // -------- Test generar punto inicial
    public function testStartingPoint() {
        // Seccion roja
        // $point1 = new Point(0 , 0, null, null, null);
        // $point2 = new Point(3 , 0, null, null, null);
        // $point3 = new Point(0 , 2, null, null, null);
        // $point4 = new Point(3 , 2, null, null, null);

        // chido
        $point1 = new Point(0 , 0, null, null, null);
        $point2 = new Point(0 , 3, null, null, null);
        $point3 = new Point(0 , 2, null, null, null);
        $point4 = new Point(2 , 3, null, null, null);

        // Seccion azul
        // $point1 = new Point(1 , 2, null, null, null);
        // $point2 = new Point(3 , 2, null, null, null);
        // $point3 = new Point(1 , 3, null, null, null);
        // $point4 = new Point(3 , 3, null, null, null);

        // chido
        // $point1 = new Point(1 , 2, null, null, null);
        // $point2 = new Point(1 , 4, null, null, null);
        // $point3 = new Point(2 , 2, null, null, null);
        // $point4 = new Point(2 , 4, null, null, null);

        // Seccion amarilla
        // $point1 = new Point(1 , 1, null, null, null);
        // $point2 = new Point(1 , 2, null, null, null);
        // $point3 = new Point(2 , 1, null, null, null);
        // $point4 = new Point(2 , 2, null, null, null);

        $correlatedNetwork = new CorrelatedNetwork(null, $point1, $point2, $point3, $point4);

        $correlatedNetwork->readMatrix();
        $correlatedNetwork->generateStartingPoint();
    }

    // -------- Test check square (crossover)
    public function testCheckSquare() {
        
        $correlatedMatrix = array ();
        for($i=0; $i<4; $i++){
            // array_push($correlatedMatrix, array(0,0,1));
            array_push($correlatedMatrix, array(1,1,1));

            // print_r($correlatedMatrix[$i]);
            // echo "<br>";
        }

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
        
        $point1 = new Point(1, 1, 0, "H", 2);
        $point2 = new Point(2, 1, 0, "P", 3);
        $point3 = new Point(2, 2, 0, "H", 2);
        $point4 = new Point(3, 3, 0, "P", 3);
        
        $childPoints_C = array($point1, $point2, $point3, $point4);
        $pointsChildren = array($point1, $point2, $point3, $point4);

        $arrayConformations = array($conformation1, $conformation2, $conformation3, $conformation4, $conformation5, $conformation6);

        $generation = new Generation($arrayConformations);

        // $cruce = new OnePoint(null, null, null, "homogeneus", $correlatedMatrix, "HPHP", $generation);
        
        $cruce = new OnePoint($generation, "correlated", "2D_Square", 4, 2, 0.5, $correlatedMatrix, "HPHP");

        // $lengthHpString = sizeof($params->parent_one);
        // $cruce->execute($lengthHpString);

        $cruce->checkSquareChildren($childPoints_C, 0, $pointsChildren, 1);
    }

    // -------- Test check triangle (crossover)
    public function testCheckTriangle() {        

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
        
        $point1 = new Point(1, 1, 0, "H", 2);
        $point2 = new Point(2, 1, 0, "P", 3);
        $point3 = new Point(2, 2, 0, "H", 2);
        $point4 = new Point(3, 3, 0, "P", 3);
        
        $childPoints_C = array($point1, $point2, $point3, $point4);
        $pointsChildren = array($point1, $point2, $point3, $point4);

        $arrayConformations = array($conformation1, $conformation2, $conformation3, $conformation4, $conformation5, $conformation6);

        $generation = new Generation($arrayConformations);

        // $cruce = new OnePoint(null, null, null, "homogeneus", $correlatedMatrix, "HPHP", $generation);
        
        $cruce = new OnePoint($generation, "correlated", "2D_Triangle", 4, 2, 0.5, null, "HPHP");

        // $lengthHpString = sizeof($params->parent_one);
        // $cruce->execute($lengthHpString);

        $cruce->checkTriangleChildren($childPoints_C, 1, $pointsChildren, 1);
    }

    public function testGenPoint() {
    $hpString = 'HPHHHPPH';

    $generate = new GenerateSquarePoints($hpString, 'homogeneous', null, '2D_Square', 'convex', 0.2);
    $generate->initializeGeneration(8);
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
            //Puntos Para el 2D Cuadrado.
            /*$points = array(
                new Point(1, 0, null, 'P', 0),
                new Point(1, 2, null, 'P', 0),
                new Point(0, 0, null, 'H', 0), 
                new Point(1, 0, null, 'H', 2),
                new Point(1, 0, null, 'H', 2),
                new Point(1, 1, null, 'P', 1)
            );*/

            //Puntos para el 2D Triangular.
            /*$points = array(
                new Point(1.5, 0, null, 'P', 1),                
                new Point(1, 0, null, 'H', 0),
                new Point(0, 0, null, 'H', 0),
                new Point(2.5, 0, null, 'P', 4),
                new Point(0.5, 0, null, 'H', 0),
                new Point(0, 1, null, 'H', 2),
                new Point(1, 1, null, 'P', 0)
            );*/

            //Puntos para el 3D Cubico.
            $points = array(
                new Point(1.5, 0, 0, 'P', 1),
                new Point(1.5, 0, null, 'H', 1),
                new Point(1.5, 0, 1, 'H', 0),
                new Point(1.5, 0, 2, 'H', 0),
                new Point(1.5, 1, 0, 'P', 0),          
                new Point(1, 0, 0, 'H', 0),
                new Point(1.5, 2, 0, 'P', 0),
                new Point(0, 0, null, 'H', 0),
                new Point(1, 0, 1, 'P', 0),
                new Point(2.5, 0, null, 'H', 4),
                new Point(0.5, 0, null, 'H', 0),
                new Point(0, 1, null, 'H', 2),
                new Point(1, 1, null, 'H', 0),
                new Point(1.5, 0, 2, 'H', 5),
                new Point(0.5, 0, 1, 'P', 1),
                new Point(1.5, 0, 1, 'P', 1)
            );
            
            $dimension = $params->dimension_type;
            $function = $params->function_type;
            $alphaValue = $params->alpha;

            $fitness = new Fitness($points, $dimension, $function, $alphaValue);
            $fts = $fitness->getFitness();
            
            $data = array(
                'code' => 200,
                'status' => 'success',
                'fitness' => $fts
            );
        } else {
            $data = array(
                'code' => 404,
                'Status' => 'error',
                'message' => "Data dosn't sending"
            );
        }

        return response()->json($data, $data['code']);
    }

    public function testOpMutationPredefined(Request $request) {
        echo 'Voy a invocar el operador de mutacion predefined<br>';
        $parentsLst = array();
        
        $parents = new Parents();
        $parents->setParent1(1);
        $parents->setParent2(0);

        $parents1 = new Parents();
        $parents1->setParent1(8);
        $parents1->setParent2(9);

        $parents2 = new Parents();
        $parents2->setParent1(5);
        $parents2->setParent2(1);

        array_push($parentsLst, $parents);
        array_push($parentsLst, $parents1);
        array_push($parentsLst, $parents2);

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

        $gen = new Generation($arrayConformations);
        $gen->setParentsList($parentsLst);

        for($i=0; $i < sizeof($parentsLst); $i++) {
            $predefined = Predefined::execute($gen, $i);
            $padre1 = $predefined[0];
            $padre2 = $predefined[1];
            $tempP = $predefined[2];

            echo 'Padre 1: '.$padre1.', Padre 2: '.$padre2.'<br>';
        }
        
        die();
    }

    public function testOpMutationRandom(Request $request) {
        echo 'Voy a invocar el operador de mutacion Random<br>';
        $parentsLst = array();
        
        $parents = new Parents();
        $parents->setParent1(1);
        $parents->setParent2(0);

        $parents1 = new Parents();
        $parents1->setParent1(8);
        $parents1->setParent2(9);

        $parents2 = new Parents();
        $parents2->setParent1(5);
        $parents2->setParent2(1);

        array_push($parentsLst, $parents);
        array_push($parentsLst, $parents1);
        array_push($parentsLst, $parents2);

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

        $gen = new Generation($arrayConformations);
        $gen->setParentsList($parentsLst);

        for($i=0; $i < sizeof($parentsLst); $i++) {
            $random = Random::execute($gen, $i);
            $padre1 = $random[0];
            $padre2 = $random[1];
            $tempP = $random[2];

            echo 'Padre 1: <strong>'.$padre1.'</strong>, Padre 2: <strong>'.$padre2.'</strong><br><br>';
        }
        
        die();
    }

}
