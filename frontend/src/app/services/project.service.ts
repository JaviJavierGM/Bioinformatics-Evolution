import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { global } from './global';

@Injectable()
export class ProjectService {
    public url: string;

    constructor(
        public _http: HttpClient
    ) {
        this.url = global.url;
    }

    save(project, token): Observable<any> {
        let json = JSON.stringify(project);
        let params = 'json='+json;

        let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded').set('Authorization', token);
        return this._http.post(this.url+'project', params, {headers: headers});
    }
}