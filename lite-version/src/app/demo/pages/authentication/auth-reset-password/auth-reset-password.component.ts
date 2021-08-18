import { AuthenticationService } from 'src/app/services/authentication.service';
import { Component, OnInit } from '@angular/core';
import { environment } from './../../../../../environments/environment.prod';

@Component({
  selector: 'app-auth-reset-password',
  templateUrl: './auth-reset-password.component.html',
  styleUrls: ['./auth-reset-password.component.scss']
})
export class AuthResetPasswordComponent implements OnInit {
  environment = environment;

  constructor(private AuthenticationService:AuthenticationService) { }

  ngOnInit() {
  }
  resetPassword(){
    let id = document.getElementById("email")['value'];
    let isvalid = this.validate(id);
    if(isvalid){
      this.AuthenticationService.resetPassword(id).subscribe(data=>{
        alert(data);
      });
    }
  }
  validate(email) {
    if (email === "" ||
      email.split("@").length !== 2 ||
      email.lastIndexOf("@") === 0) {
       alert("Please Enter Valid Email");
       return false;
     }
     return true; // allow whatever
  }

}
