import {Component, ElementRef, OnInit, ViewChild} from '@angular/core';
import {EngineService} from './engine.service';
import { ResultsDataService } from 'src/app/services/results-data.service';
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
  selector: 'app-engine',
  templateUrl: './engine.component.html'
})
export class EngineComponent implements OnInit {

  @ViewChild('rendererCanvas', {static: true})
  public rendererCanvas: ElementRef<HTMLCanvasElement>;
  private httpClient: HttpClient;
  private matrix: string;
  private arrayCubes: Array<axisTocube>;

  GenerateIMG(){
    //console.log(this.engServ.canvas.toDataURL("image/jpeg", 1.0));
    let data = this.engServ.canvas.toDataURL("image/jpg", 1.0);
    let filename = 'my-canvas.jpeg';
    let a = document.createElement('a');
    a.href = data;
    a.download = filename;
    document.body.appendChild(a);
    a.click();

  } 
  
  public constructor(private engServ: EngineService, public resultsData: ResultsDataService,http: HttpClient) {
    this.httpClient = http;
    this.arrayCubes = new Array();
  }

  
  public ngOnInit(): void {

    // Datos de la red donde si se puede plegar
    console.log('Datos red correlacionada')
    this.resultsData.fileNameCorrelatedNetwork = "icp37";
    this.resultsData.upperLeftPoint = [594,208];
    this.resultsData.upperRightPoint = [681,208];
    this.resultsData.lowerLeftPoint = [594,261];
    this.resultsData.lowerRightPoint = [681,261];


    var linea=Array();
    var Matriz=Array();

    this.httpClient.get('assets/correlatedNetworks/cp45.txt', { responseType: 'text' })
    .subscribe(data =>
      {
        this.matrix = data;
        for (let index = 0; index < data.length+1; index++) {
          if (data[index]=='\n' ) {
            Matriz.push(linea);
            linea=Array();
          }
          if (data[index]=='0' ) {
            linea.push(0)
          }
          if (data[index]=='1' ) {
            linea.push(1)
          }
        }
        this.matriz_to_Axis(Matriz);

      } 
      );

    // console.log(data[0]);
    // console.log(Matriz);    
    console.log(this.resultsData.fileNameCorrelatedNetwork);
    console.log(this.resultsData.upperLeftPoint);
    console.log(this.resultsData.upperRightPoint);
    console.log(this.resultsData.lowerLeftPoint);
    console.log(this.resultsData.lowerRightPoint);

    

    

  }

  matriz_to_Axis(Matriz:Array<Array<number>>){
    this.resultsData.upperLeftPoint = [498,417]; //x1,y1
    this.resultsData.upperRightPoint = [518,417]; //x2,y1
    this.resultsData.lowerLeftPoint = [498,435]; //x1,y2
    this.resultsData.lowerRightPoint = [518,435]; //x2,y2
    let canFolding_there;
    for (let i = 0; i < this.resultsData.upperRightPoint[0]-this.resultsData.upperLeftPoint[0] ; i++) {
      for (let k = 0; k < this.resultsData.lowerRightPoint[1]-this.resultsData.upperLeftPoint[1] ; k++) {
        console.log(Matriz[i][k])
        if (Matriz[i][k]==1) {
          this.arrayCubes.push(new axisTocube(this.resultsData.upperLeftPoint[0]+i*6,this.resultsData.upperLeftPoint[1]+k*6,0,true))
        }else{
          this.arrayCubes.push(new axisTocube(this.resultsData.upperLeftPoint[0]+i*6,this.resultsData.upperLeftPoint[1]+k*6,0,false))
        }
        
      }
      
    }

    this.engServ.createScene(this.rendererCanvas,this.arrayCubes);
    this.engServ.animate();



    //new axisTocube(5*6,28*6,0,false)
  }
}

