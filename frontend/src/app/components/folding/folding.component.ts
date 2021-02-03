import { Component, OnInit } from '@angular/core';
import { EvolutionaryAlgorithm } from '../../models/evolutionaryAlgorithm';
import { UserService } from '../../services/user.service';

@Component({
  selector: 'app-folding',
  templateUrl: './folding.component.html',
  styleUrls: ['./folding.component.css'],
  providers: [UserService]
})
export class FoldingComponent implements OnInit {
  public page_title: string;
  public evolutionaryAlgorithm: EvolutionaryAlgorithm;
  public identity;
  public token;

  constructor(
    private _userService: UserService
  ) { 
    this.page_title = 'Protein folding';
    this.evolutionaryAlgorithm = new EvolutionaryAlgorithm('', 'lattice', '2D_Square', 'simple', 'roulette', 'one_point', 'predefined', 100, 200, 1, 1, 20, 20, 1.0, 0.0, 0.01, 0.01);
    this.identity = this._userService.getIdentity();
    this.token = this._userService.getToken();
  }

  ngOnInit(): void {
    console.log("Plegamiento!!!");
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

  saveProject() {
    console.log('Se guardara el proyecto en la DB');
    console.log(this.evolutionaryAlgorithm);
  }

}
