import { SkeletonService } from './../../../../../services/skeleton.service';
import { AuthenticationService } from 'src/app/services/authentication.service';
import { Router } from '@angular/router';
import {Component, OnInit} from '@angular/core';
import {NgbDropdownConfig} from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-nav-right',
  templateUrl: './nav-right.component.html',
  styleUrls: ['./nav-right.component.scss'],
  providers: [NgbDropdownConfig]
})
export class NavRightComponent implements OnInit {
  user:any = [];
  constructor(private router: Router,
              private AuthenicationService: AuthenticationService,
              private SkeletonService: SkeletonService) { }

  ngOnInit() {
    this.user = this.AuthenicationService.getUser();
   }

  logOut(){
    this.AuthenicationService.signOut().subscribe(data=>{
      console.log(data);
      return this.router.navigate(['']);
    });
  }
  getPicture(picture){
    return this.SkeletonService.getTeacherPictures(picture);
  }
}
