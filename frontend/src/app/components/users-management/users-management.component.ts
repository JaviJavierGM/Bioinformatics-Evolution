import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-users-management',
  templateUrl: './users-management.component.html',
  styleUrls: ['./users-management.component.css']
})
export class UsersManagementComponent implements OnInit {
  public page_title: string;

  constructor() { 
    this.page_title = "User's Management";
  }

  ngOnInit(): void {
  }

}
