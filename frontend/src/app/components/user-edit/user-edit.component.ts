import { Component, OnInit } from '@angular/core';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';
import { global } from "../../services/global";

@Component({
  selector: 'app-user-edit',
  templateUrl: './user-edit.component.html',
  styleUrls: ['./user-edit.component.css'],
  providers: [UserService]
})
export class UserEditComponent implements OnInit {
  public page_title: string;
  public user: User;
  public identity;
  public token;
  public status;
  public url;
  public afuConfig = this.initializeAfuConfig();

  constructor(
    private _userService: UserService
  ){ 
    this.page_title = 'Edit personal information!';
    this.user = new User(1, '', '', '', '', '', '', '');
    this.identity = this._userService.getIdentity();
    this.token = this._userService.getToken();
    this.url = global.url;
    
    // Rellenar objeto usuario
    this.user = this.initializeUser();

  }

  ngOnInit(): void {
  }

  initializeUser(){
    let user = new User( 
      this.identity.sub, 
      this.identity.name, 
      this.identity.surname, 
      this.identity.role, 
      this.identity.email, 
      '', 
      this.identity.description, 
      this.identity.image);
    return user;
  }

  initializeAfuConfig(){
    let afuConfig = {
      multiple: false,
      formatsAllowed: ".jpg, .png, .gif, .jpeg",
      maxSize: "20",
      uploadAPI:  {
        url: global.url+'user/upload',
        method:"POST",
        headers: {
          "Authorization": this._userService.getToken()
        },
        params: {
          'page': '1'
        },
        responseType: 'json',
      },
      theme: "attachPin",
      hideProgressBar: false,
      hideResetBtn: true,
      hideSelectBtn: false,
      fileNameIndex: true,

      replaceTexts: {
        selectFileBtn: 'Select Files',
        resetBtn: 'Reset',
        uploadBtn: 'Upload',
        dragNDropBox: 'Drag N Drop',
        attachPinBtn: 'Upload a different photo',
        afterUploadMsg_success: 'Successfully Uploaded',
        afterUploadMsg_error: 'Upload Failed',
        sizeLimit: 'Size Limit'
      }
    };
    return afuConfig;
  }

  onSubmit(form) {
    this._userService.update(this.token, this.user).subscribe(
      response => {
        if(response && response.status) {
          this.status = 'success';

          // Actualizar usuario en sesion
          if(response.changes.name){
            this.user.name = response.changes.name;
          }
          if(response.changes.surname){
            this.user.surname = response.changes.surname;
          }
          if(response.changes.email){
            this.user.email = response.changes.email;
          }
          if(response.changes.description){
            this.user.description = response.changes.description;
          }
          if(response.changes.image){
            this.user.image = response.changes.image;
          }

          this.identity = this.user;
          console.log(this.identity);
          localStorage.setItem('identity', JSON.stringify(this.identity));

        }else{
          this.status = 'error';
        }
      },
      error => {
        this.status = 'error';
        console.log(<any>error);
      }
    );
  }

  imageUpload(datos){
    let data_obj = datos.body;
    this.user.image = data_obj.image;
  
  }

}
