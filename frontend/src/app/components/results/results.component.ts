import { Component, OnInit,ElementRef,ViewChild } from '@angular/core';
import { ResultsDataService } from 'src/app/services/results-data.service';
import { Folding } from '../../models/folding';
import { Project } from '../../models/project';
import {EngineService} from '../../services/engine.service';
import {Engine3DService} from '../../services/engine3-d.service'
import {Engine2DCorrelatedService} from '../../services/engine2dcorrelated.service'

import { ChartDataSets, ChartType, ChartOptions } from 'chart.js';
import { HttpClient } from '@angular/common/http';


class axisTocube {
  posX: number;
  posY: number;
  posZ: number;
  value: boolean;
  constructor(X:number,Y:number,Z:number,value: boolean){
    this.posX=X;
    this.posY=Y;
    this.posZ=Z;
    this.value=value;
  }
}

@Component({
  selector: 'app-results',
  templateUrl: './results.component.html',
  styleUrls: ['./results.component.css']
})

export class ResultsComponent implements OnInit {
  public page_title: string;
  public experiments: any[][];
  public dimensionType: string;
  public spaceType: string;
  public folding: Folding;
  public plot: Folding;
  public myDatatxt:string;
  public project: Project;
  public params;


  data: Array<any> = new Array<any>();
  //variables to graphs
  public scatterChartOptions: ChartOptions = {
    responsive: true,
  };
  public scatterChartData: ChartDataSets[] ;
  public scatterChartType: ChartType = 'scatter';



  @ViewChild('rendererCanvas', {static: true})
  public rendererCanvas: ElementRef<HTMLCanvasElement>;
  private httpClient: HttpClient;
  private arrayCubes: Array<axisTocube>;
  private counter_NET:number;
  
  constructor(
    private engServ: EngineService, 
    private engServ3D: Engine3DService, 
    private engServ2D_Correlated:Engine2DCorrelatedService ,
    public resultsData: ResultsDataService,
    http: HttpClient
  ) {
    this.page_title = 'Results of the Evolutionary Algorithm!!';
    this.folding = new Folding(0, 0, 0);
    this.plot = new Folding(0, 0, 0);
    this.httpClient = http;
    this.arrayCubes = new Array();
    this.counter_NET=0;
    this.params = JSON.parse(localStorage.getItem('params'));
    this.project = new Project(0, '', this.params.aminoacid, this.params.space_type, this.params.dimension_type, this.params.optimization_algorithm, this.params.selection_op, this.params.crossover_op, this.params.mutation_op, this.params.elitism, this.params.clamp_mutation, this.params.caterpillar_mutation, this.params.conformations, this.params.times_algorithm, this.params.experiments, this.params.sampling, this.params.percent_tournament, this.params.percent_best, this.params.crossover_probability, this.params.min_mutation_probability, this.params.max_mutation_probability, this.params.proximity_pairing, this.params.final_fitness, this.params.i_know_fitness, this.params.fitness_function, this.params.alpha_value, this.params.mutation_probability, this.params.percent_elitism, this.params.upperLeftPoint, this.params.upperRightPoint, this.params.lowerLeftPoint, this.params.lowerRightPoint, this.params.fileNameCorrelatedNetwork, this.experiments);
  }

  ngOnInit(): void {
    this.experiments = this.resultsData.resultsExperiments;
    this.dimensionType = this.resultsData.dimensionType;
    this.spaceType = this.resultsData.spaceType;
  }

  onSubmit(form) {
    let generation = this.experiments[this.folding.experiment][this.folding.generation];
    let conformationClone = generation[0][this.folding.conformation];

    if(this.spaceType=='correlated'){      
      if(this.counter_NET == 0){
        //console.log(this.resultsData.upperLeftPoint);
        //console.log(this.resultsData.upperRightPoint);
        //console.log(this.resultsData.lowerLeftPoint);
        //console.log(this.resultsData.lowerRightPoint);
        this.resultsData.fileNameCorrelatedNetwork = this.resultsData.fileNameCorrelatedNetwork.replace('i','');
        this.counter_NET++;
        this.getFile();
      }
      this.engServ2D_Correlated.createScene(this.rendererCanvas,conformationClone ,this.arrayCubes);
      this.engServ2D_Correlated.animate();

    } else if(this.dimensionType == '3D_Cubic' ){
      this.engServ3D.createScene(this.rendererCanvas, conformationClone);
      this.engServ3D.animate();    
    } else {
      this.engServ.createScene(this.rendererCanvas, conformationClone);
      this.engServ.animate();    
    }

    
  }

  private getFile(){
    var linea=Array();
    this.httpClient.get('assets/correlatedNetworks/' + this.resultsData.fileNameCorrelatedNetwork + '.txt', { responseType: 'text' })
      .subscribe(data => {
        for (let index = 0; index < data.length + 1; index++) {
          if (data[index] == '\n') {
            this.data.push(linea);
            linea = Array();
          }
          if (data[index] == '0') {
            linea.push(0);
          }
          if (data[index] == '1') {
            linea.push(1);
          }
        }
        this.matriz_to_Axis(this.data);
      }
      );
  }

  private matriz_to_Axis(Matriz:Array<Array<number>> ){
    let cont = 0;
   
    for (let i = 0; i < this.resultsData.lowerLeftPoint[1]- this.resultsData.upperLeftPoint[1] +1; i++) {
      for (let k = 0; k < this.resultsData.upperRightPoint[0] - this.resultsData.upperLeftPoint[0]  +1; k++) {
        if (Matriz[this.resultsData.upperLeftPoint[1]+i][this.resultsData.upperLeftPoint[0]+k]==1) {
          this.arrayCubes.push(new axisTocube(k*6,i*6*-1,0,false))
        }else{
          this.arrayCubes.push(new axisTocube(k*6,i*6*-1,0,true))
        }
      }      
    }
  }



  graphSumFitness(form:any) {
    let mydata =[];

    for (let i = 0; i < this.experiments[this.plot.experiment].length; i++) {
      mydata.push({
        'x': i,
        'y': this.experiments[this.plot.experiment][i].totalFitnessGeneration*-1
      });   
    }

    this.scatterChartData =[ { data: mydata,label: 'Particular generation vs Sum fitness',pointRadius: 3 }, ];
  }

  graphFitnessParticularGeneration(form:any) {   
    let generation =  this.experiments[this.plot.experiment][this.plot.generation];
    let mydata =[]; 

    for (let i = 0; i < generation[0].length; i++) {
      mydata.push({
        'x': i,
        'y': generation[0][i].fitness*-1 
      });   
    }
    this.scatterChartData =[ { data: mydata,label: 'Particular generation vs particular fitness ', pointRadius: 3 } ];  
  }

  GenerateIMG(){
    let data:any;
    if(this.spaceType=='correlated'){
      data=this.engServ2D_Correlated.canvas.toDataURL("image/jpg",1.0);
    } else if(this.dimensionType == '3D_Cubic' ){
      data = this.engServ3D.canvas.toDataURL("image/jpg", 1.0);   
    } else {
      data = this.engServ.canvas.toDataURL("image/jpg", 1.0);  
    }

    let filename = 'my-canvas.jpg';
    let a = document.createElement('a');
    a.href = data;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
  }

  GenerateIMGasJPEG() {
    let data:any;
    if(this.spaceType=='correlated'){
      data=this.engServ2D_Correlated.canvas.toDataURL("image/jpeg",1.0);

    }
    else if(this.dimensionType == '3D_Cubic' ){
      data = this.engServ3D.canvas.toDataURL("image/jpeg", 1.0);   
    } else {
      data = this.engServ.canvas.toDataURL("image/jpeg", 1.0);  
    }


    let filename = 'my-canvas.jpeg';
    let a = document.createElement('a');
    a.href = data;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
  }

  GenerateIMGasPNG() {
    let data:any;
    if(this.spaceType=='correlated'){
      data=this.engServ2D_Correlated.canvas.toDataURL("image/png",1.0);

    }
    else if(this.dimensionType == '3D_Cubic' ){
      data = this.engServ3D.canvas.toDataURL("image/png", 1.0);   
    } else {
      data = this.engServ.canvas.toDataURL("image/png", 1.0);  
    }


    let filename = 'my-canvas.png';
    let a = document.createElement('a');
    a.href = data;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
  }

  GenerateIMGasGIF() {
    let data:any;
    if(this.spaceType=='correlated'){
      data=this.engServ2D_Correlated.canvas.toDataURL("image/gif",1.0);

    }
    else if(this.dimensionType == '3D_Cubic' ){
      data = this.engServ3D.canvas.toDataURL("image/gif", 1.0);   
    } else {
      data = this.engServ.canvas.toDataURL("image/gif", 1.0);  
    }


    let filename = 'my-canvas.gif';
    let a = document.createElement('a');
    a.href = data;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
  }

  GenerateIMGasTIFF() {
    let data:any;
    if(this.spaceType=='correlated'){
      data=this.engServ2D_Correlated.canvas.toDataURL("image/tiff",1.0);
    }
    else if(this.dimensionType == '3D_Cubic' ){
      data = this.engServ3D.canvas.toDataURL("image/tiff", 1.0);   
    } else {
      data = this.engServ.canvas.toDataURL("image/tiff", 1.0);  
    }


    let filename = 'my-canvas.tiff';
    let a = document.createElement('a');
    a.href = data;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
  }

  saveProject() {
    console.log("EL proyectos se va a guardar xD!")
    this.project.results = this.experiments;
    console.log(this.project);
  }

}
