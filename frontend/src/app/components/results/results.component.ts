import { Component, OnInit,ElementRef,ViewChild } from '@angular/core';
import { ResultsDataService } from 'src/app/services/results-data.service';
import { Folding } from '../../models/folding';
import {EngineService} from '../../services/engine.service';
import {Engine3DService} from '../../services/engine3-d.service'

@Component({
  selector: 'app-results',
  templateUrl: './results.component.html',
  styleUrls: ['./results.component.css']
})
export class ResultsComponent implements OnInit {
  public page_title: string;
  public experiments;
  public dimensionType: string;
  public spaceType: string;
  public folding: Folding;
  public plot: Folding;

  @ViewChild('rendererCanvas', {static: true})
  public rendererCanvas: ElementRef<HTMLCanvasElement>;

  GenerateIMG(){
    //console.log(this.engServ.canvas.toDataURL("image/jpeg", 1.0));
    
    let data:any;
    if(this.dimensionType == '3D_Cubic' ){
      data = this.engServ3D.canvas.toDataURL("image/jpg", 1.0);   
    }else {
      data = this.engServ.canvas.toDataURL("image/jpg", 1.0);  
    }


    let filename = 'my-canvas.jpg';
    let a = document.createElement('a');
    a.href = data;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
  }
  
  constructor(
    private engServ: EngineService, 
    private engServ3D: Engine3DService, 
    public resultsData: ResultsDataService
  ) {
    this.page_title = 'Results of the Evolutionary Algorithm!!';
    this.folding = new Folding(0, 0, 0);
    this.plot = new Folding(0, 0, 0);
  }

  ngOnInit(): void {
  
    this.experiments = this.resultsData.resultsExperiments;
    this.dimensionType = this.resultsData.dimensionType;
    this.spaceType = this.resultsData.spaceType;

    
  
    
    console.log('Componente de resultados!!');
    /* console.log(this.experiments);
    console.log(this.dimensionType);
    console.log(this.spaceType); */

  }

  onSubmit(form) {
    let generation = this.experiments[this.folding.experiment][this.folding.generation];
    let conformationClone = generation[0][this.folding.conformation];

    console.log(conformationClone);
    
    if(this.dimensionType == '3D_Cubic' ){

      this.engServ3D.createScene(this.rendererCanvas, conformationClone);
      this.engServ3D.animate();    
    }else {

      this.engServ.createScene(this.rendererCanvas, conformationClone);
      this.engServ.animate();    
    }

    
  }

  graphSumFitness() {
    console.log('Aqui se hace la grafica de la suma de fitness de cada generacion!!');
  }

  graphFitnessParticularGeneration(form) {
    console.log('Aqui se hace la grafica el fitness de cada conformacion!!');
    console.log(this.plot);

    let generation =  this.experiments[this.plot.experiment][this.plot.generation];
    console.log(generation);
    
  }



}
