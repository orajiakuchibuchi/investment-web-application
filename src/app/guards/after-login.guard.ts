import { AuthenticationService } from './../services/authentication.service';
import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, RouterStateSnapshot, Router , UrlTree, CanActivate } from '@angular/router';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AfterLoginGuard implements CanActivate {
  canActivate(
    next: ActivatedRouteSnapshot,
    state:  RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    let isLoggedIn = this.Token.loggedIn();
    return isLoggedIn ? isLoggedIn : this.router.navigate(['']);
    }
    constructor(private Token: AuthenticationService, private router: Router){}
  }
