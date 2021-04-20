import {Component, ElementRef, OnInit, ViewChild} from '@angular/core';
import {EngineService} from './engine.service';
import { ResultsDataService } from 'src/app/services/results-data.service';
import { HttpClient } from '@angular/common/http';


@Component({
  selector: 'app-engine',
  templateUrl: './engine.component.html'
})
export class EngineComponent implements OnInit {

  @ViewChild('rendererCanvas', {static: true})
  public rendererCanvas: ElementRef<HTMLCanvasElement>;
  private httpClient: HttpClient;
  private matrix: string;

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
  }

  
  public ngOnInit(): void {

    // Datos de la red donde si se puede plegar
    console.log('Datos red correlacionada')
    this.resultsData.fileNameCorrelatedNetwork = "icp37";
    this.resultsData.upperLeftPoint = [594,208];
    this.resultsData.upperRightPoint = [681,208];
    this.resultsData.lowerLeftPoint = [594,261];
    this.resultsData.lowerRightPoint = [681,261];


    // let linea=String;
    let linea=Array();
    let matriz=Array();

    this.httpClient.get('assets/correlatedNetworks/cp37.txt', { responseType: 'text' })
      .subscribe(
        data => {

          // leer la matriz
          var salto=data[2000];
          data=data+salto;

          for(var i=0; i<data.length; i++){
            if(data[i] == salto){
            
              var arrayTemp = Array();
              for(var j=0; j<linea.length; j++){
                arrayTemp[j] = linea[j];
              }
              matriz.push(arrayTemp);
              linea.splice(0, linea.length);

            }else{
              if(data[i]=="0" || data[i]=="1"){
                linea.push(parseInt(data[i], 10));
              }
            }            
          }
          console.log(matriz);

          // seleccionar solo una parte          
          let verticalSide = Math.sqrt( Math.pow(this.resultsData.lowerLeftPoint[0]-this.resultsData.upperLeftPoint[0], 2) +  Math.pow(this.resultsData.lowerLeftPoint[1]-this.resultsData.upperLeftPoint[1] , 2) ) + 1;
          console.log("verticalSide "+verticalSide);          
          let horizontalSide = Math.sqrt( Math.pow(this.resultsData.upperRightPoint[0]-this.resultsData.upperLeftPoint[0], 2) +  Math.pow(this.resultsData.upperRightPoint[1]-this.resultsData.upperLeftPoint[1] , 2) ) + 1;
          console.log("horizontalSide "+horizontalSide);

          let matrixSeleted = Array();
          let lineTemp = Array();

          for(var i=this.resultsData.upperLeftPoint[0]; i<this.resultsData.upperLeftPoint[0]+verticalSide; i++){

            for(var j=this.resultsData.upperLeftPoint[1]; j<this.resultsData.upperLeftPoint[1]+horizontalSide; j++){

              lineTemp.push(matriz[i][j]);

            }

            var arrayTemp2 = Array();
            for(var x=0; x<lineTemp.length; x++){
              arrayTemp2[x] = lineTemp[x];
            }
            matrixSeleted.push(arrayTemp2);
            lineTemp.splice(0, lineTemp.length);

          }

          console.log(matrixSeleted);

        }
    );

    // console.log(data[0]);
    // console.log(Matriz);    
    console.log(this.resultsData.fileNameCorrelatedNetwork);
    console.log(this.resultsData.upperLeftPoint);
    console.log(this.resultsData.upperRightPoint);
    console.log(this.resultsData.lowerLeftPoint);
    console.log(this.resultsData.lowerRightPoint);

    
    
    
    
    
      
    

    this.engServ.createScene(this.rendererCanvas);
    this.engServ.animate();

  }


}

