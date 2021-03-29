import { Component, OnInit } from '@angular/core';
import { Folding } from '../../models/folding';

@Component({
  selector: 'app-results',
  templateUrl: './results.component.html',
  styleUrls: ['./results.component.css']
})
export class ResultsComponent implements OnInit {
  public page_title: string;
  public experiments;
  public folding: Folding;

  constructor() {
    this.page_title = 'Results of the Evolutionary Algorithm!!';
    this.folding = new Folding(0, 0, 0);
  }

  ngOnInit(): void {
    this.experiments = localStorage.getItem('results');
    this.experiments = JSON.parse(this.experiments);
    localStorage.removeItem('results');
    console.log('Componente de resultados!!');
    console.log(this.experiments);
  }

  onSubmit(form) {
    let conformationClone = this.experiments[this.folding.conformation];

    for (let i = 0; i < conformationClone.points.length; i++) {
      console.log(conformationClone.points[i]);      
    }
  }

}
