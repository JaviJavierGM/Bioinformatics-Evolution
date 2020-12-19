// NECESSARY IMPORTS
import { ModuleWithProviders } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

// COMPONENTS IMPORTS
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { HomeComponent } from './components/home/home.component';
import { FoldingComponent } from './components/folding/folding.component';
import { ErrorComponent } from './components/error/error.component';
import { Route } from '@angular/compiler/src/core';


// DEFINE ROUTES
const appRoutes: Routes = [
    {path: '', component: HomeComponent},
    {path: 'login', component: LoginComponent},
    {path: 'register', component: RegisterComponent},
    {path: 'folding', component: FoldingComponent},
    {path: '**', component: ErrorComponent}
];

// EXPORT CONFIGURATION
export const appRoutingProviders: any[] = [];
export const routing: ModuleWithProviders<Route> = RouterModule.forRoot(appRoutes);
