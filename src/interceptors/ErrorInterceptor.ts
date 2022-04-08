import { WINDOW } from '@ng-toolkit/universal';
import { Injectable, Inject } from '@angular/core';
import { HttpInterceptor, HttpEvent, HttpResponse, HttpRequest, HttpHandler } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { tap, catchError, retry } from 'rxjs/operators';
import 'rxjs/add/operator/catch';
import 'rxjs/add/observable/empty';
@Injectable()
export class ErrorInterceptor implements HttpInterceptor {
  constructor(@Inject(WINDOW) private window: Window) {}
  intercept(httpRequest: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    return this.handler(next, httpRequest);
  }
  handler(next, request) {
    return next.handle(request).pipe(
      retry(1),
      tap(evt => {if (evt instanceof HttpResponse) {}}),
      catchError((error) => {
        // const rollbar = this.injector.get(RollbarService);
        let errorMessage = '';
        if (error.error instanceof ErrorEvent) {
          // client-side error
          errorMessage = `Error: ${error.error.message}`;
        } else {
          // server-side error
          if (error.status === 401) {
            // this.authService.remove();
          }
          errorMessage = `Server error. Please try again later`;
        }
        this.window.alert(errorMessage);
        // this.spinnerService.requestEnded();
        this.window.location.reload();
        return throwError(errorMessage);
    }));
  }
}
