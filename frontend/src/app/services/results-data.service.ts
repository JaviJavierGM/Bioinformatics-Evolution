import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ResultsDataService {

  public resultsExperiments;
  public dimensionType;
  public spaceType;

  public upperRightPoint;
  public upperLeftPoint;
  public lowerRightPoint;
  public lowerLeftPoint;

  constructor() { }

}