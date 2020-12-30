import { Component, OnInit } from '@angular/core';
import { EvolutionaryAlgorithm } from '../../models/evolutionaryAlgorithm';

@Component({
  selector: 'app-folding',
  templateUrl: './folding.component.html',
  styleUrls: ['./folding.component.css']
})
export class FoldingComponent implements OnInit {
  public page_title: string;
  public evolutionaryAlgorithm: EvolutionaryAlgorithm;

  constructor() { 
    this.page_title = 'Protein folding';
    this.evolutionaryAlgorithm = new EvolutionaryAlgorithm('', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
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

}
