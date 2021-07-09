// NECESSARY IMPORTS
import { Component, ModuleWithProviders } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

// COMPONENTS IMPORTS
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { HomeComponent } from './components/home/home.component';
import { FoldingComponent } from './components/folding/folding.component';
import { ProjectsComponent } from './components/projects/projects.component';
import { UserEditComponent } from './components/user-edit/user-edit.component';
import { UsersManagementComponent } from './components/users-management/users-management.component';
import { ResultsComponent } from './components/results/results.component';
import { SelectCorrelatedNetworkComponent } from "./components/select-correlated-network/select-correlated-network.component";
import { ErrorComponent } from './components/error/error.component';
import { Route } from '@angular/compiler/src/core';



// DEFINE ROUTES
const appRoutes: Routes = [
    {path: '', component: HomeComponent},
    {path: 'login', component: LoginComponent},
    {path: 'logout/:sure', component: LoginComponent},
    {path: 'register', component: RegisterComponent},
    {path: 'folding', component: FoldingComponent},
    {path: 'projects', component: ProjectsComponent},
    {path: 'settings', component: UserEditComponent},
    {path: 'users-management', component: UsersManagementComponent},
    {path: 'results', component: ResultsComponent},
    {path: 'select-correlated-network', component: SelectCorrelatedNetworkComponent},
    {path: '**', component: ErrorComponent}
];

// EXPORT CONFIGURATION
export const appRoutingProviders: any[] = [];
export const routing: ModuleWithProviders<Route> = RouterModule.forRoot(appRoutes);
