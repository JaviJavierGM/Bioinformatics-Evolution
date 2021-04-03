import { Component, ElementRef, OnInit, ViewChild } from '@angular/core';

@Component({
  selector: 'app-select-correlated-network',
  templateUrl: './select-correlated-network.component.html',
  styleUrls: ['./select-correlated-network.component.css']
})
export class SelectCorrelatedNetworkComponent implements OnInit {

  constructor() { }

  event: MouseEvent;

  public initialClientX = null;
  public initialClientY = null;

  public finalClientX = 0;
  public finalClientY = 0;

  public xEvent = null;
  public yEvent = null;

  public flagDraw = true;

  startClick(event: MouseEvent): any {
    // console.log("initial:",event);

    var boardCorrelatedNetwork = document.getElementById("boardCorrelatedNetwork");
    var ClientRect = boardCorrelatedNetwork.getBoundingClientRect();
    
    this.initialClientX = event.clientX - ClientRect.left;
    this.initialClientY = event.clientY - ClientRect.top;

    console.log("Initial -- x:",this.initialClientX," y:",this.initialClientY);
  }

  releaseClick(event: MouseEvent): any {
    // console.log("final:",event);
     
    var boardCorrelatedNetwork = document.getElementById("boardCorrelatedNetwork");
    var ClientRect = boardCorrelatedNetwork.getBoundingClientRect();
    
    this.finalClientX = event.clientX - ClientRect.left;
    this.finalClientY = event.clientY - ClientRect.top;
    
    console.log("Final -- x:",this.finalClientX," y:",this.finalClientY);

    this.flagDraw = false;
    
  }

  drawArea(event: MouseEvent): any {
    if(this.initialClientX != null && this.initialClientY && this.flagDraw) {
      console.log('Iniciar dibujar area');
      // console.log(event);
      var canvas = <HTMLCanvasElement> document.getElementById("boardCorrelatedNetwork");
      var ctx = canvas.getContext('2d');

      var boardCorrelatedNetwork = document.getElementById("boardCorrelatedNetwork");
      var ClientRect = boardCorrelatedNetwork.getBoundingClientRect();

      ctx.lineWidth = 3;
      ctx.strokeStyle = "#A91F1F";

      if(this.xEvent == null && this.yEvent == null && this.xEvent == event.clientX - ClientRect.left && this.yEvent == event.clientY - ClientRect.top) {
        ctx.strokeRect(this.initialClientX, this.initialClientY, this.xEvent-this.initialClientX, this.yEvent-this.initialClientY);
      } else {
        // ctx.clearRect(this.initialClientX, this.initialClientY, this.xEvent-this.initialClientX, this.yEvent-this.initialClientY);
        ctx.clearRect(0, 0, 1000, 1000);
        this.xEvent = event.clientX - ClientRect.left;
        this.yEvent = event.clientY - ClientRect.top;
        ctx.strokeRect(this.initialClientX, this.initialClientY, this.xEvent-this.initialClientX, this.yEvent-this.initialClientY);
      }

      
      

      



    }else{
      console.log('AUN NO dibujar area!!!!');
      // console.log(event);
    }
  }

  ngOnInit(): void {

  }



}
