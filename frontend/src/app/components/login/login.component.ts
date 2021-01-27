import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params } from '@angular/router';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';

@Component({
  selector: 'login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
  providers: [UserService]
})
export class LoginComponent implements OnInit {
  public page_title: string;
  public user: User;
  public status: string;
  public errors;
  public token;
  public identity;

  constructor(
    private _userService: UserService,
    private _router: Router,
    private _route: ActivatedRoute
  ) { 
    this.page_title = 'Welcome back!';
    this.user = new User(1, '', '', 'ROLE_USER', '', '', '', '');

    // Instruccion para cerrar el menu desplegrable luego de seleccionar
    // Pendiente de verificar como se usa jquery en angular
    // $('.navbar-collapse').collapse('hide');

  }

  ngOnInit(): void {
    // Se ejecuta siempre y cierra sesion solo cuando llega el parametro sure por la url 
    this.logout();
  }

  onSubmit(form) {
    this._userService.signup(this.user).subscribe(
      response => {
        // Token
        if(response.status != 'error') {
          this.status = 'success';
          this.token = response;

          // Objeto usuario identificado
          this._userService.signup(this.user, true).subscribe(
            response => {
              this.identity = response;
              console.log(this.token);
              console.log(this.identity);

              // Persistir datos del usuario identificado
              localStorage.setItem('token', this.token);
              localStorage.setItem('identity', JSON.stringify(this.identity));

              // Redirecion a inicio
              if(this.identity.role == 'ROLE_USER') {
                this._router.navigate(['folding']);
              } else {
                this._router.navigate(['']);
              }
              
            },
            error => {
              this.status = 'error';
              console.log(<any>error);
            }
          );

        } else {
          this.status = 'error';
          console.log(response);
        }
      },
      error => {
        this.status = 'error';
        console.log(<any>error);
      }
    );
  }

  logout() {
    this._route.params.subscribe( params => {
      let logout = +params['sure'];

      if(logout == 1) {
        localStorage.removeItem('token');
        localStorage.removeItem('identity');

        this.identity = null;
        this.token = null;

        // Redirecion a inicio
        this._router.navigate(['']);
      }
    });
  }

}
