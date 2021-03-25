import {Component, ElementRef, OnInit, ViewChild} from '@angular/core';
import {Folding2DService} from './folding2-d.service'
@Component({
  selector: 'app-folding2-d',
  templateUrl: './folding2-d.component.html',
  styleUrls: ['./folding2-d.component.css']
})
export class Folding2DComponent implements OnInit {

  @ViewChild('rendererCanvas', {static: true})
  public rendererCanvas: ElementRef<HTMLCanvasElement>;

 public constructor(private engServ: Folding2DService) {
  }

  ngOnInit(): void {
    this.engServ.createScene(this.rendererCanvas);
    this.engServ.animate();
  }

}
