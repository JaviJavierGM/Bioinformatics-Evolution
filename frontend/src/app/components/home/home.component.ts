import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  public page_title: string;
  public posts;

  constructor() { 
    this.page_title = 'Home';
    this.posts = new Array('Post #1', 'Post #2', 'Post #3', 'Post #4','Post #5', 'Post #6');
  }

  ngOnInit(): void {
    console.log(this.posts);
  }

}
