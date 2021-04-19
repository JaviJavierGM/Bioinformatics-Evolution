import {Component, ElementRef, OnInit, ViewChild} from '@angular/core';
import {EngineService} from './engine.service';
import { ResultsDataService } from 'src/app/services/results-data.service';

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
  
  public constructor(private engServ: EngineService, public resultsData: ResultsDataService) {
  }


  public ngOnInit(): void {

    // Datos de la red donde si se puede plegar
    console.log('Datos red correlacionada')
    this.resultsData.fileNameCorrelatedNetwork = "icp47";
    this.resultsData.upperLeftPoint = [594,208.89999389648438];
    this.resultsData.upperRightPoint = [681,208.89999389648438];
    this.resultsData.lowerLeftPoint = [594,261.8999938964844];
    this.resultsData.lowerRightPoint = [681,261.8999938964844];

    console.log(this.resultsData.fileNameCorrelatedNetwork);
    console.log(this.resultsData.upperLeftPoint);
    console.log(this.resultsData.upperRightPoint);
    console.log(this.resultsData.lowerLeftPoint);
    console.log(this.resultsData.lowerRightPoint);

    this.engServ.createScene(this.rendererCanvas);
    this.engServ.animate();
  }

}
