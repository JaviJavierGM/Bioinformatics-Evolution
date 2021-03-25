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

  ngOnInit(): void {
    this.engServ.createScene(this.rendererCanvas);
    this.engServ.animate();
  }

}
