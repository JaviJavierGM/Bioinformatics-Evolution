import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ResultsDataService {

  public resultsExperiments;
  public dimensionType;
  public spaceType;

  public upperRightPoint: number[];
  public upperLeftPoint: number[];
  public lowerRightPoint: number[];
  public lowerLeftPoint: number[];

  public fileNameCorrelatedNetwork: string;

  constructor() { }

}