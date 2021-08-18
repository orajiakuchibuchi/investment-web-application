import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';
import { environment } from './../../environments/environment';
// import { NgxSpinnerService } from "ngx-spinner";
@Injectable({
  providedIn: 'root'
})
export class SkeletonService {
  private deployment:string = environment.url;
  private local:string = environment.url + '/storage';
  private baseUrl:string = this.local;
  private loader = new BehaviorSubject(false);
  constructor() { }
  getTeacherPictures(image){
    return this.baseUrl + '/' + image;
  }
  getStudentPictures(image){
    return this.baseUrl + '/' + image;
  }
  loaderState(){
    return this.loader;
  }
  showLoader(){
    this.loader.next(true);
    return this.loader;
  }
  turnOffLoader(){
    this.loader.next(false);
    return this.loader;
  }
}
