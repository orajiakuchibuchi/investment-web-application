import { Component, OnInit } from '@angular/core';
import { environment } from './../../../../../environments/environment.prod';

@Component({
  selector: 'app-auth-change-password',
  templateUrl: './auth-change-password.component.html',
  styleUrls: ['./auth-change-password.component.scss']
})
export class AuthChangePasswordComponent implements OnInit {
  environment = environment;
  constructor() { }

  ngOnInit() {
  }

}
