import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-folding',
  templateUrl: './folding.component.html',
  styleUrls: ['./folding.component.css']
})
export class FoldingComponent implements OnInit {
  public page_title: string;

  constructor() { 
    this.page_title = 'Protein folding';
  }

  ngOnInit(): void {
    console.log("Plegamiento!!!");
  }

}
