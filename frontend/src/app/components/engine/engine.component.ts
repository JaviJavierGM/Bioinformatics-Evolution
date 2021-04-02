import {Component, ElementRef, OnInit, ViewChild} from '@angular/core';
import {EngineService} from './engine.service';

@Component({
  selector: 'app-engine',
  templateUrl: './engine.component.html'
})
export class EngineComponent implements OnInit {

  @ViewChild('rendererCanvas', {static: true})
  public rendererCanvas: ElementRef<HTMLCanvasElement>;

  GenerateIMG(){
    //console.log(this.engServ.canvas.toDataURL("image/jpeg", 1.0));
    let data = this.engServ.canvas.toDataURL("image/jpeg", 1.0);
    let filename = 'my-canvas.jpeg';
    let a = document.createElement('a');
    a.href = data;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
  }
  
  public constructor(private engServ: EngineService) {
  }


  public ngOnInit(): void {
    this.engServ.createScene(this.rendererCanvas);
    this.engServ.animate();
  }

}
