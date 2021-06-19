import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, RouterStateSnapshot, Router, UrlTree, CanActivate } from '@angular/router';
import { Observable } from 'rxjs';
import { AuthenticationService } from './../services/authentication.service';

@Injectable({
  providedIn: 'root'
})
export class BeforeLoginGuard implements CanActivate {
  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    let isLog = !this.Token.loggedIn();
    return isLog ? isLog : this.router.navigate(['authenticated/dashboard/analytics']);
  }
  constructor(private Token: AuthenticationService, private router: Router){}

}
