import { Component, OnInit, ViewChild, ElementRef, AfterViewInit, HostListener } from '@angular/core';

@Component({
  selector: 'app-select-correlated-network',
  templateUrl: './select-correlated-network.component.html',
  styleUrls: ['./select-correlated-network.component.css']
})
export class SelectCorrelatedNetworkComponent implements OnInit {

  @ViewChild('boardCorrelatedNetwork', {static: true}) 
  public boardCorrelatedNetwork: ElementRef; 

  @ViewChild('output', {static: true}) 
  public output: ElementRef;

  // @HostListener('click') onClick() {
  //   window.alert('Host Element Clicked');
  // }
  // @HostListener('mouseover') onMouseOver() {
  //   window.alert('Host Element Clicked');
  // }
  
  public context: CanvasRenderingContext2D;

  constructor() { }

  ngOnInit(): void {
  
    this.context = this.boardCorrelatedNetwork.nativeElement.getContext('2d');      
    
    if(this.context){
      console.log("contexto bien")
      this.boardCorrelatedNetwork.nativeElement.addEventListener("mouseover", function(evt){
        
        // var mousePos = this.oMousePos(this.boardCorrelatedNetwork.nativeElement, evt);
		    // this.marcarCoords(this.output, mousePos.x, mousePos.y)

        console.log(this.boardCorrelatedNetwork.nativeElement.getBoundingClientRect());
        
      }, false);
    }

  }

  oMousePos(canvas, evt) {
    var ClientRect = canvas.getBoundingClientRect();
    return { //objeto
      x: Math.round(evt.clientX - ClientRect.left),
      y: Math.round(evt.clientY - ClientRect.top)
    }
  }

  marcarCoords(output, x, y) {
    output.nativeElement.innerHTML = ("x: " + x + ", y: " + y);
    output.nativeElement.style.top = (y + 10) + "px";
    output.nativeElement.style.left = (x + 10) + "px";
    output.nativeElement.style.backgroundColor = "#FFF";
    output.nativeElement.style.border = "1px solid #d9d9d9"
    //canvas.style.cursor = "pointer";
  }

/*
  var canvas = document.getElementById("lienzo");
		if (canvas && canvas.getContext) {
		  var ctx = canvas.getContext("2d");
		  if (ctx) {


		    var output = document.getElementById("output"); ---------

		    canvas.addEventListener("mousemove", function(evt) {
		      var mousePos = oMousePos(canvas, evt);
		      marcarCoords(output, mousePos.x, mousePos.y)
		    }, false);

		    canvas.addEventListener("mouseout", function(evt) {
		      limpiarCoords(output);
		    }, false);


		  }
		}
*/


}
