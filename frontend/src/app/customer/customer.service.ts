import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
    
import {  Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';
   
import { Customer } from './customer';

@Injectable({
  providedIn: 'root'
})
export class CustomerService {

  private apiURL = "http://localhost/application-test/backend/";
    
  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json'
    })
  }

  constructor(private httpClient: HttpClient) { }
    
  getAll(): Observable<Customer[]> {
    return this.httpClient.get<Customer[]>(this.apiURL)
    .pipe(
      catchError(this.errorHandler)
    )
  }
    
  create(customer: Customer): Observable<Customer> {
    return this.httpClient.post<Customer>(this.apiURL, JSON.stringify(customer), this.httpOptions)
    .pipe(
      catchError(this.errorHandler)
    )
  }  
    
  find(id: number): Observable<Customer> {
    return this.httpClient.get<Customer>(this.apiURL + "?id=" +  id)
    .pipe(
      catchError(this.errorHandler)
    )
  }
    
  update(id: number, customer: Customer): Observable<Customer> {
    return this.httpClient.put<Customer>(this.apiURL + "?id=" + id, JSON.stringify(customer), this.httpOptions)
    .pipe(
      catchError(this.errorHandler)
    )
  }
    
  delete(id: number){
    return this.httpClient.delete<Customer>(this.apiURL + "?id=" + id, this.httpOptions)
    .pipe(
      catchError(this.errorHandler)
    )
  }
     
   
  errorHandler(error: any) {
    let errorMessage = '';
    if(error.error instanceof ErrorEvent) {
      errorMessage = error.error.message;
    } else {
      errorMessage = `Error Code: ${error.status}\nMessage: ${error.message}`;
    }
    return throwError(errorMessage);
 }
}
