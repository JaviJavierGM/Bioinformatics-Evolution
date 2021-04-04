import { Component, OnInit} from '@angular/core';
import { ResultsDataService } from 'src/app/services/results-data.service';

@Component({
  selector: 'app-select-correlated-network',
  templateUrl: './select-correlated-network.component.html',
  styleUrls: ['./select-correlated-network.component.css']
})
export class SelectCorrelatedNetworkComponent implements OnInit {

  constructor(
    public resultsData: ResultsDataService
  ) { }

  event: MouseEvent;

  public initialClientX = null;
  public initialClientY = null;

  public finalClientX = 0;
  public finalClientY = 0;

  public xEvent = null;
  public yEvent = null;

  public upperRightPoint:number[] = [0, 0];
  public upperLeftPoint:number[] = [0, 0];
  public lowerRightPoint:number[] = [0, 0];
  public lowerLeftPoint:number[] = [0, 0];

  public flagDraw = true;
  public previouslyDrawn = false;

  startClick(event: MouseEvent): void {

    if(this.flagDraw == false){
      this.initialClientX = null;
      this.initialClientY = null;
      this.flagDraw = true;
    }

    var boardCorrelatedNetwork = document.getElementById("boardCorrelatedNetwork");
    var ClientRect = boardCorrelatedNetwork.getBoundingClientRect();
    
    this.initialClientX = event.clientX - ClientRect.left;
    this.initialClientY = event.clientY - ClientRect.top;

    console.log("Initial -- x:",this.initialClientX," y:",this.initialClientY);
  }

  releaseClick(event: MouseEvent): void {
    // console.log("final:",event);
     
    var boardCorrelatedNetwork = document.getElementById("boardCorrelatedNetwork");
    var ClientRect = boardCorrelatedNetwork.getBoundingClientRect();
    
    this.finalClientX = event.clientX - ClientRect.left;
    this.finalClientY = event.clientY - ClientRect.top;
    
    console.log("Final -- x:",this.finalClientX," y:",this.finalClientY);

    this.flagDraw = false;

    this.makePoints();

    this.resultsData.upperLeftPoint = this.upperLeftPoint;
    this.resultsData.upperRightPoint = this.upperRightPoint;
    this.resultsData.lowerLeftPoint = this.lowerLeftPoint;
    this.resultsData.lowerRightPoint = this.lowerRightPoint;

    console.log("upper Left:",this.upperLeftPoint);
    console.log("upper Right:",this.upperRightPoint);

    console.log("lower Left:",this.lowerLeftPoint);
    console.log("lower Right:",this.lowerRightPoint);
    
  }

  drawArea(event: MouseEvent): void {

    if(this.initialClientX != null && this.initialClientY && this.flagDraw) {
      
      var canvas = <HTMLCanvasElement> document.getElementById("boardCorrelatedNetwork");
      
      if(canvas &&  canvas.getContext){
        var ctx = canvas.getContext('2d');

        var boardCorrelatedNetwork = document.getElementById("boardCorrelatedNetwork");
        var ClientRect = boardCorrelatedNetwork.getBoundingClientRect();

        ctx.lineWidth = 3;
        ctx.strokeStyle = "#A91F1F";

        if(this.xEvent == null && this.yEvent == null && this.xEvent == event.clientX - ClientRect.left && this.yEvent == event.clientY - ClientRect.top) {
          // Dibuja
          ctx.strokeRect(this.initialClientX, this.initialClientY, this.xEvent-this.initialClientX, this.yEvent-this.initialClientY);
        } else {
          // Borra primero
          ctx.clearRect(0, 0, 1000, 1000);
          // Actualiza datos
          this.xEvent = event.clientX - ClientRect.left;
          this.yEvent = event.clientY - ClientRect.top;
          // Dibuja
          ctx.strokeRect(this.initialClientX, this.initialClientY, this.xEvent-this.initialClientX, this.yEvent-this.initialClientY);
        }  
      }
      
    }

  }

  makePoints(): void {

    if(this.initialClientX > this.finalClientX && this.initialClientY > this.finalClientY) {
      // Se contempla el caso en el que el usuario selecciono de extremo inferior dercho a extremo superior izquierdo
      var temp;

      if(this.initialClientX > this.finalClientX) {
        temp = this.finalClientX;
        this.finalClientX = this.initialClientX;
        this.initialClientX = temp;
      }

      if(this.initialClientY > this.finalClientY) {
        temp = this.finalClientY;
        this.finalClientY = this.initialClientY;
        this.initialClientY = temp;
      }   
    }

    // De otra forma se considera que el usuario selecciono del extremo superior izquierdo al extremo inferior derecho
    this.upperLeftPoint[0] = this.subtractDot5(this.initialClientX);
    this.upperLeftPoint[1] = this.subtractDot5(this.initialClientY);

    this.upperRightPoint[0] = this.subtractDot5(this.finalClientX);
    this.upperRightPoint[1] = this.subtractDot5(this.initialClientY);

    this.lowerLeftPoint[0] = this.subtractDot5(this.initialClientX);
    this.lowerLeftPoint[1] = this.subtractDot5(this.finalClientY);

    this.lowerRightPoint[0] = this.subtractDot5(this.finalClientX);
    this.lowerRightPoint[1] = this.subtractDot5(this.finalClientY);
  
  }

  subtractDot5(number): number{
    if((number % 1) != 0){
      number -= .5;
    }
    return number;
  }

  ngOnInit(): void {

  }



}
