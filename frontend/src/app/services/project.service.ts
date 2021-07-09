import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { User } from '../models/user';
import { global } from './global';

@Injectable()
export class ProjectService {
    public url: string;
    public identity;
    public token;

    constructor(
        public _http: HttpClient
    ) {
        this.url = global.url;
    }
}