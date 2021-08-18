import { SkeletonService } from './../app/services/skeleton.service';
import { Router } from '@angular/router';
import { Injectable } from '@angular/core';
import { HttpInterceptor, HttpEvent, HttpResponse, HttpRequest, HttpHandler } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { map, filter,tap, catchError } from 'rxjs/operators';
import { AuthenticationService } from '../app/services/authentication.service';
import 'rxjs/add/operator/catch';
import 'rxjs/add/observable/empty';
@Injectable()
export class HeaderInterceptor implements HttpInterceptor {
  constructor(private AuthenticationService: AuthenticationService, private router: Router,
    private SkeletonService:SkeletonService){}
  intercept(httpRequest: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    this.SkeletonService.showLoader();
    const authReq = httpRequest.clone({
    setHeaders: {
          'Authorization': `Bearer-${this.AuthenticationService.getToken()}`
          // 'Content-Type': 'application/x-www-form-urlencoded'
        }
      });
      const btn = document.querySelector('button');
      if(btn){
        btn.disabled = true;
      }
        return next.handle(authReq).pipe(tap(evt => {
          setTimeout(()=>{
            if(btn){
              btn.disabled = false;
            }
            this.SkeletonService.turnOffLoader();
          }, 4000);
      }),catchError((error)=>{
      this.router.navigate(['/authenticated/maintenance/error'], {
        queryParams: error
      });
    // this response is handled
    // stop the chain of handlers by returning empty
    return Observable.empty();
    }));
  }
}
