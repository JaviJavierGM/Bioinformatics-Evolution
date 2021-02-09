import { Component, OnInit, DoCheck } from '@angular/core';
import { EvolutionaryAlgorithm } from '../../models/evolutionaryAlgorithm';
import { UserService } from '../../services/user.service';

@Component({
  selector: 'app-folding',
  templateUrl: './folding.component.html',
  styleUrls: ['./folding.component.css'],
  providers: [UserService]
})
export class FoldingComponent implements OnInit, DoCheck {
  public page_title: string;
  public evolutionaryAlgorithm: EvolutionaryAlgorithm;
  public finalFitness: boolean;
  public identity;
  public token;

  constructor(
    private _userService: UserService
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
    console.log(this.evolutionaryAlgorithm);
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
