import { Component, ElementRef, OnInit, ViewChild } from '@angular/core';

@Component({
  selector: 'app-select-correlated-network',
  templateUrl: './select-correlated-network.component.html',
  styleUrls: ['./select-correlated-network.component.css']
})
export class SelectCorrelatedNetworkComponent implements OnInit {

  // @ViewChild('boardCorrelatedNetwork', {static: true}) 
  // public boardCorrelatedNetwork: ElementRef; 

  constructor() { }

  event: MouseEvent;
  clientX = 0;
  clientY = 0;
  // canvas = get

  onEvent(event: MouseEvent): void {
      this.event = event;
  }

  coordinates(event: MouseEvent): void {
      this.clientX = event.clientX;
      this.clientY = event.clientY;
  }

  getCoordinates(event: MouseEvent): any {
    // console.log(this.boardCorrelatedNetwork.nativeElement.getBoundingClientRect());
    var boardCorrelatedNetwork = document.getElementById("boardCorrelatedNetwork");
    var ClientRect = boardCorrelatedNetwork.getBoundingClientRect();
    // console.log(ClientRect);
    this.clientX = event.clientX - ClientRect.left;
    this.clientY = event.clientY - ClientRect.top;

    console.log("x:",this.clientX," y:",this.clientY);
    // console.log(this.clientY);
  }

  ngOnInit(): void {

  }



}
