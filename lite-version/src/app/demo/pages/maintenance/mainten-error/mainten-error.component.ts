import { AuthenticationService } from './../../../../services/authentication.service';
import { Observable } from 'rxjs';
import { ActivatedRoute, Router } from '@angular/router';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-mainten-error',
  templateUrl: './mainten-error.component.html',
  styleUrls: ['./mainten-error.component.scss']
})
export class MaintenErrorComponent implements OnInit {

  constructor(private ActivatedRoute: ActivatedRoute, private router: Router, private auth: AuthenticationService) { }
  error_information :any;
  ngOnInit() {
    // this.error_information = .
    this.ActivatedRoute.queryParams.subscribe(params => {
      this.error_information = params;
    });
  //   this.error_information$ = this.ActivatedRoute.paramMap
  //     .pipe(map(() => window.history.state))
  // }
  }
  reAuthentication(){
    if(this.error_information.error == 'Session expired'){
      this.auth.signOut().subscribe(data=>{
        return this.router.navigate(['']);
      });
    }

  }

}
