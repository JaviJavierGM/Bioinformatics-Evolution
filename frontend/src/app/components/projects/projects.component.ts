import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-projects',
  templateUrl: './projects.component.html',
  styleUrls: ['./projects.component.css']
})
export class ProjectsComponent implements OnInit {
  public page_title: string;
  public projects;

  constructor() { 
    this.page_title = 'My projects !!';
    this.projects = Array('Proyecto #1', 'Proyecto #2', 'Proyecto #3', 'Proyecto #4','Proyecto #5');
  }

  ngOnInit(): void {
    console.log('Projectos lanzados correctamente!');
    console.log(this.projects);
  }

}
