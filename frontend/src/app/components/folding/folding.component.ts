import { Component, OnInit, DoCheck } from '@angular/core';
import { Router } from '@angular/router';
import { ResultsDataService } from 'src/app/services/results-data.service';
import { EvolutionaryAlgorithm } from '../../models/evolutionaryAlgorithm';
import { EvolutionaryAlgorithmService } from '../../services/evolutionaryAlgorithm.service';
import { UserService } from '../../services/user.service';

@Component({
  selector: 'app-folding',
  templateUrl: './folding.component.html',
  styleUrls: ['./folding.component.css'],
  providers: [EvolutionaryAlgorithmService, UserService]
})
export class FoldingComponent implements OnInit, DoCheck {
  public page_title: string;
  public evolutionaryAlgorithm: EvolutionaryAlgorithm;
  public finalFitness: boolean;
  public results;
  public identity;
  public token;
  public status;
  public loading=false;
  public correlatedNetworks: string[];
  public url: string;

  constructor(
    private _userService: UserService,
    private _evolutionaryAlgorithmService: EvolutionaryAlgorithmService,
    private _router: Router,
    public resultsData: ResultsDataService
  ) { 
    this.page_title = 'Protein folding';
    this.finalFitness = false;
    this.evolutionaryAlgorithm = new EvolutionaryAlgorithm(
      '', 
      'lattice', 
      '2D_Square', 
      'simple', 
      'roulette', 
      'one_point', 
      'predefined', 
      false, 
      false, 
      false, 
      100, 
      200, 
      1, 
      1, 
      20,
      20, 
      1.0, 
      0.0, 
      0.01, 
      0.01, 
      28, 
      false, 
      'dill_model',
      0.1,
      0.01,
      2,
      this.resultsData.upperLeftPoint,
      this.resultsData.upperRightPoint,
      this.resultsData.lowerLeftPoint,
      this.resultsData.lowerRightPoint,
      null
    );
    this.identity = this._userService.getIdentity();
    this.token = this._userService.getToken();
    this.correlatedNetworks = Array("icp37", "icp38", "icp39", "icp40", "icp41", "icp42", "icp43", "icp44", "icp45", "icp46", "icp47", "icp48", "icp49", "icp50");
    this.url = "../../../assets/images/correlatedNetworks/";
  }

  ngOnInit(): void {
    console.log("Plegamiento!!!");
  }

  ngDoCheck() {
    this.isRankGaOptimization();
  }

  onSubmit(form) {
    this.loading=true;
    console.log(this.evolutionaryAlgorithm);
    if(this.evolutionaryAlgorithm.space_type == "correlated") {
      // Setear los puntos de la red correlacionada
      this.evolutionaryAlgorithm.setPointsCorrelatedNetwork2D(this.resultsData.upperLeftPoint, this.resultsData.upperRightPoint, this.resultsData.lowerLeftPoint, this.resultsData.lowerRightPoint);
    }    
    this._evolutionaryAlgorithmService.execute(this.evolutionaryAlgorithm).subscribe(
      response => {
        console.log(response);
        if(response.status == "success") {
          this.status = response.status;
          
          // Persistir los resultados devuletos por el API
          console.log(response.experiments);
          this.resultsData.resultsExperiments = response.experiments;
          this.resultsData.dimensionType = response.dimension_type;
          this.resultsData.spaceType = response.space_type;

          // Redirecion al componente para visualizar los resultaados del EA.
          this._router.navigate(['results']);
        } else {
          this.status = 'error';
        }
      },
      error => {
        this.status = 'error';
        console.log(<any>error);
      }
    );
  }

  isRankGaOptimization() {
    if(this.evolutionaryAlgorithm.optimization_algorithm == 'rankGA') {
      this.evolutionaryAlgorithm.elitism = true;
    }
  }

  saveProject() {
    console.log('Se guardara el proyecto en la DB');
    console.log(this.evolutionaryAlgorithm);
  }

  selectCorrelatedNetwork(nameFile) {
    this.evolutionaryAlgorithm.fileNameCorrelatedNetwork = nameFile;
    this.resultsData.fileNameCorrelatedNetwork = this.evolutionaryAlgorithm.fileNameCorrelatedNetwork;

  }

  test() {
    console.log('Esto es un metodo de prueba para el modal xD');
  }
}
