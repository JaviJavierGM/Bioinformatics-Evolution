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

  constructor(
    private _userService: UserService,
    private _evolutionaryAlgorithmService: EvolutionaryAlgorithmService,
    private _router: Router,
    private resultsExperiments: ResultsDataService
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
      2
    );
    this.identity = this._userService.getIdentity();
    this.token = this._userService.getToken();
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
    this._evolutionaryAlgorithmService.execute(this.evolutionaryAlgorithm).subscribe(
      response => {
        if(response.status == "success") {
          this.status = response.status;
          // this.results = JSON.stringify(response.experiments);
          
          // Persistir los resultados devuletos por el API
          // localStorage.setItem('results', this.results);
          this.resultsExperiments.resultsExperiments = response.experiments;

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
}
