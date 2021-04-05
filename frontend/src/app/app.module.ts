import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { routing, appRoutingProviders } from './app.routing';
import { FroalaEditorModule, FroalaViewModule } from 'angular-froala-wysiwyg';
import { EditorModule } from '@tinymce/tinymce-angular';
import { AngularFileUploaderModule } from "angular-file-uploader";
import {ChartsModule} from 'ng2-charts';

import { AppComponent } from './app.component';
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { HomeComponent } from './components/home/home.component';
import { ErrorComponent } from './components/error/error.component';
import { FoldingComponent } from './components/folding/folding.component';
import { AutoFocusDirective } from './auto-focus.directive';
import { ProjectsComponent } from './components/projects/projects.component';
import { UserEditComponent } from './components/user-edit/user-edit.component';
import { UsersManagementComponent } from './components/users-management/users-management.component';
import { EngineComponent } from './components/engine/engine.component';

import { Engine3DComponent } from './components/engine3-d/engine3-d.component';
import { ResultsComponent } from './components/results/results.component';
import { SelectCorrelatedNetworkComponent } from './components/select-correlated-network/select-correlated-network.component';



@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    RegisterComponent,
    HomeComponent,
    ErrorComponent,
    FoldingComponent,
    AutoFocusDirective,
    ProjectsComponent,
    UserEditComponent,
    UsersManagementComponent,
    EngineComponent,

    Engine3DComponent,

    ResultsComponent,

    SelectCorrelatedNetworkComponent,
      
  ],
  imports: [
    BrowserModule,
    routing,
    FormsModule,
    HttpClientModule,
    ChartsModule,
    FroalaEditorModule.forRoot(),
    FroalaViewModule.forRoot(),
    AngularFileUploaderModule,
    EditorModule
  ],
  providers: [
    appRoutingProviders
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
