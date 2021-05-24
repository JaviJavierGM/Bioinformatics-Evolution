import { Component,ElementRef, OnInit,ViewChild } from '@angular/core';
import {Engine3DService} from './engine3-d.service'

@Component({
  selector: 'app-engine3-d',
  templateUrl: './engine3-d.component.html',
  styleUrls: ['./engine3-d.component.css']
})
export class Engine3DComponent implements OnInit {

  @ViewChild('rendererCanvas', {static: true})
  public rendererCanvas: ElementRef<HTMLCanvasElement>;

  public constructor(private engServ: Engine3DService) {
  }
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
  
  ngOnInit(): void {
    this.engServ.createScene(this.rendererCanvas);
    this.engServ.animate();
  }

}
