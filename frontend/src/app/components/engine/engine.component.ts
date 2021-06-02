import {Component, ElementRef, OnInit, ViewChild} from '@angular/core';
import {EngineService} from './engine.service';
import { ResultsDataService } from 'src/app/services/results-data.service';
import { HttpClient } from '@angular/common/http';
/* import { jsPDF } from 'jspdf'
import html2canvas from 'html2canvas'
 */

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
  private matrix: Array<any>;
  private dataTEXT:string;
  private arrayCubes: Array<axisTocube>;
  //private matrix_get :DevRequestService
  


  GenerateIMG(){
    //console.log(this.engServ.canvas.toDataURL("image/jpeg", 1.0));
    let data = this.engServ.canvas.toDataURL("image/png", 1.0);
    let filename = 'my-canvas.png';
    let a = document.createElement('a');

    /* var doc = new jsPDF('p', 'mm');
    const pageWidth = doc.internal.pageSize.getWidth();
    
    
    doc.addImage(data,'SVG',15,40,200,250); 
    doc.save(filename)
    */

    a.href = data;
    a.download = filename;
    document.body.appendChild(a);
    a.click();

  } 
  
  public constructor(private engServ: EngineService, public resultsData: ResultsDataService,http: HttpClient) {
    this.httpClient = http;
    this.arrayCubes = new Array();
    //this.matrix_get =matrix_get;

  }

  
  public ngOnInit(): void {

    // Datos de la red donde si se puede plegar
    console.log('Datos red correlacionada')
    //this.resultsData.fileNameCorrelatedNetwork = this.resultsData.fileNameCorrelatedNetwork.replace('i','');
    /* this.resultsData.upperLeftPoint = [594,208];
    this.resultsData.upperRightPoint = [681,208];
    this.resultsData.lowerLeftPoint = [594,261];
    this.resultsData.lowerRightPoint = [681,261];
     */
    
   /*  console.log(this.resultsData.upperRightPoint);
    console.log(this.resultsData.lowerLeftPoint);
    console.log(this.resultsData.lowerRightPoint); */


   /*  
   var linea=Array();
   var Matriz=Array();

   this.httpClient.get('assets/correlatedNetworks/'+this.resultsData.fileNameCorrelatedNetwork+'.txt', { responseType: 'text' })
   .subscribe(data =>
     {
       
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
     
       
       this.matriz_to_Axis();
      
     } 
     ); */
    
     this.matriz_to_Axis();
    //console.log(this.matrix_get.getmatrix(this.resultsData.fileNameCorrelatedNetwork));

    // console.log(data[0]);
    //console.log(this.resultsData.fileNameCorrelatedNetwork.replace('i',''));
    console.log(this.dataTEXT);    
    console.log(this.resultsData.fileNameCorrelatedNetwork);
    console.log(this.resultsData.upperLeftPoint);
    console.log(this.resultsData.upperRightPoint);
    console.log(this.resultsData.lowerLeftPoint);
    console.log(this.resultsData.lowerRightPoint);

    

    

  }



  matriz_to_Axis(){
    /* this.resultsData.upperLeftPoint = [498,417]; //x1,y1
    this.resultsData.upperRightPoint = [518,417]; //x2,y1
    this.resultsData.lowerLeftPoint = [498,435]; //x1,y2
    this.resultsData.lowerRightPoint = [518,435]; //x2,y2 */
    let Matriz= [[1,0,0],[1,1,0],[1,1,1]];
    
    console.log(Matriz);
    for (let i = 0; i < Matriz.length; i++) {
      for (let j = 0; j < Matriz[0].length; j++) {
        //console.log(this.resultsData.upperLeftPoint[0]+j,"  ", this.resultsData.upperLeftPoint[1]+i );
        console.log('\n'+Matriz[i][j],j,i);
        if (Matriz[i][j]==1) {
          this.arrayCubes.push(new axisTocube(j*6,i*6*-1,0,true))
        }else{
          this.arrayCubes.push(new axisTocube(j*6,i*6*-1,0,false))
        }
        
      }

      
    }

    console.log(this.arrayCubes)

    this.engServ.createScene(this.rendererCanvas,this.arrayCubes);
    this.engServ.animate();



    //new axisTocube(5*6,28*6,0,false)
  }
}

