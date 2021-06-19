import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from "@angular/common/http";
import { environment } from './../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class AuthenticationService {
  private deployment:string = environment.url;
  private local:string = environment.url;
  private baseUrl:string = this.local;
  authUrl:string = `${this.baseUrl}/auth`;
  private iss = {
    login: `${this.authUrl}/login`,
    register: `${this.authUrl}/register`
  };
  constructor(private http: HttpClient) { }
  login(data){
    return this.http.post(`${this.authUrl}/login`,data);
  }
  resetPassword(email){
    return this.http.get(`${this.authUrl}/reset-password/${email}`);
  }
  register(data){
    return this.http.post(`${this.authUrl}/register`,data);
  }
  handle(token){
    this.set(token);
  }
  set(data){
    localStorage.setItem('tp-current-user', JSON.stringify(data));
  }
  getToken(){
    let item = JSON.parse(localStorage.getItem('tp-current-user'));
    if(!item){
      return false;
    }
    return item['token'];
  }
  getRole(){
    let item = JSON.parse(localStorage.getItem('tp-current-user'));
    if(!item){
      return false;
    }
    return item['user']['role'];
  }
  remove(){
    localStorage.removeItem('tp-current-user');
  }
  isValid(){
    const token = this.getToken();
    if(token){
      const payLoad = this.payLoad(token);
      if(payLoad){
        return Object.values(this.iss).indexOf(payLoad.iss) > -1;
      }
    }
    return false;
  }
  payLoad(token){
    const payload =  token.split('.')[1];
    return this.decode(payload);
  }
  decode(payload){
    return JSON.parse(atob(payload));
  }
  loggedIn(){
    return this.isValid();
  }
  isAdmin(){
    let role = this.getRole();
    return role == 1 ? true : false;
  }
  isTeacher(){
    let role = this.getRole();
    return role == 2 ? true : false;
  }
  isStudent(){
    let role = this.getRole();
    return role == 3 ? true : false;
  }
  getUser(){
    let user = JSON.parse(localStorage.getItem('tp-current-user'));
    return user ? user : null;
  }
  signOut(){
    this.remove();
    return this.http.get(`${this.authUrl}/sign-out`);
  }
}
