import { Component, OnInit,ElementRef,ViewChild } from '@angular/core';
import { Folding } from '../../models/folding';
import {EngineService} from '../../services/engine.service';

@Component({
  selector: 'app-results',
  templateUrl: './results.component.html',
  styleUrls: ['./results.component.css']
})
export class ResultsComponent implements OnInit {
  public page_title: string;
  public experiments;
  public folding: Folding;

  @ViewChild('rendererCanvas', {static: true})
  public rendererCanvas: ElementRef<HTMLCanvasElement>;

  constructor(private engServ: EngineService) {
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

    

    this.engServ.createScene(this.rendererCanvas,conformationClone);
    this.engServ.animate();
  }

}
