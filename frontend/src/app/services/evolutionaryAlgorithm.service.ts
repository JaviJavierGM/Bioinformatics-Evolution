import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { global } from './global';

@Injectable()
export class EvolutionaryAlgorithmService {
    public url: string;
    public response;
    public status;

    constructor(
        public _http: HttpClient
    ) {
        this.url = global.url;
    }

    test() {
        return 'Hola mundo desde el servicio del AE !!!';
    }

    execute(EA): Observable<any> {
        let json = JSON.stringify(EA);
        let params = 'json='+json;

        let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded');
        return this._http.post(this.url+'EA/execute', params, {headers: headers});
    }
}