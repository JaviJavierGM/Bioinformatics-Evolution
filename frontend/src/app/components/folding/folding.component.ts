import { Component, OnInit, DoCheck } from '@angular/core';
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
  public identity;
  public token;
  public status;

  constructor(
    private _userService: UserService,
    private _evolutionaryAlgorithmService: EvolutionaryAlgorithmService
  ) { 
    this.page_title = 'Protein folding';
    this.finalFitness = false;
    this.evolutionaryAlgorithm = new EvolutionaryAlgorithm('', 'lattice', '2D_Square', 'simple', 'roulette', 'one_point', 'predefined', false, false, false, 100, 200, 1, 1, 20, 20, 1.0, 0.0, 0.01, 0.01, 28);
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
    //console.log(this.evolutionaryAlgorithm);
    this._evolutionaryAlgorithmService.execute(this.evolutionaryAlgorithm).subscribe(
      response => {
        if(response.status == "success") {
          this.status = response.status;
          console.log(response);
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

  isCorrelational() {
    if (this.evolutionaryAlgorithm.space_type == 'correlated') {
      return true;
    } else {
      return false;
    }
  }

  iknowTheFinalFitness() {
    this.finalFitness = true;
  }

  isRankGaOptimization() {
    if(this.evolutionaryAlgorithm.optimization_algorithm == 'rankGA') {
      this.evolutionaryAlgorithm.elitism = true;
    } else {
      this.evolutionaryAlgorithm.elitism = false;
    }
  }

  saveProject() {
    console.log('Se guardara el proyecto en la DB');
    console.log(this.evolutionaryAlgorithm);
  }
}
