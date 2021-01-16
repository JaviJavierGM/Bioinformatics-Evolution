import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  public page_title: string;

  constructor() { 
    this.page_title = 'Welcome back!';

    // Instruccion para cerrar el menu desplegrable luego de seleccionar
    // Pendiente de verificar como se usa jquery en angular
    // $('.navbar-collapse').collapse('hide');

  }

  ngOnInit(): void {
  }

}
