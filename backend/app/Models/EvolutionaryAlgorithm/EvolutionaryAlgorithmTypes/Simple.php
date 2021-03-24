<?php

namespace App\Models\EvolutionaryAlgorithm\EvolutionaryAlgorithmTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\Roulette;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\Tournament;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\TopPercent;
use App\Models\EvolutionaryAlgorithm\SelectionTypes\PopulationDecimation;
use App\Models\EvolutionaryAlgorithm\CoupleFormationTypes\SimplexCoupleFormation;

class Simple extends Model
{
    use HasFactory;
    private $isKnowBestFitness;
    private $generationsNumber;
    private $experimentsNumber;
    private $sampling;
    private $selectionOperator;
    private $currentExperiment;
    private $percent;
    private $dimensionType;

    public function __construct(
        $isKnowBestFitness,
        $generationsNumber,
        $experimentsNumber,
        $sampling,
        $selectionOperator,
        $currentExperiment,
        $percent,
        $dimensionType
    ) {
        $this->isKnowBestFitness = $isKnowBestFitness;
        $this->generationsNumber = $generationsNumber;
        $this->experimentsNumber = $experimentsNumber;
        $this->sampling = $sampling;
        $this->selectionOperator = $selectionOperator;
        $this->currentExperiment = $currentExperiment;
        $this->percent = $percent;
        $this->dimensionType = $dimensionType;

        // Caso de saber el mejor fitness del projecto
        if($this->isKnowBestFitness) {
            $execute = $this->executeVersion2();
        } else {
            $execute = $this->executeVersion1();
        }
        die();

        return $execute;
    }

    public function executeVersion1() {
        echo 'Esta es la version 1 xD la mmlona xD';

        $j = 1;
        for($i=0; $i < $this->generationsNumber; $i++) {
            if ($this->selectionOperator == 'roulette') {
                $roulette = new Roulette($generation);
                if(!($roulette->execute())){
                    return false;
                }
            } elseif($this->selectionOperator == 'tournament') {
                $tournament = new Tournament($generation, $this->percent);
                if(!($tournament->execute())) {
                    return false;
                }
            } elseif($this->selectionOperator == 'top_percent') {
                $topPercent = new TopPercent($generation, $this->percent);
                if(!($topPercent->execute())) {
                    return false;
                }
            } elseif($this->selectionOperator == 'population_decimation') {
                $populationDec = new PopulationDecimation($generation);
                if(!($populationDec->execute())) {
                    return false;
                }
            }

            $coupleFormation = new SimplexCoupleFormation($generation);
            $coupleFormation->coupleFormation();

            if($this->dimensionType == '2D_Square') {

            } elseif($this->dimensionType == '2D_Triangle') {

            } elseif($this->dimensionType == '3D_Cubic') {

            }
        }
    }

    public function executeVersion2() {
        echo 'Esta es la version 2 xD la mmlona xD';
    }
}
