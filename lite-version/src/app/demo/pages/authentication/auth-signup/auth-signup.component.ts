import { environment } from './../../../../../environments/environment.prod';
import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Router, ActivatedRoute} from "@angular/router";
import { AuthenticationService } from 'src/app/services/authentication.service';
@Component({
  selector: 'app-auth-signup',
  templateUrl: './auth-signup.component.html',
  styleUrls: ['./auth-signup.component.scss']
})
export class AuthSignupComponent implements OnInit {
  credientials: any = {
    password: {
      visibility: false
    }
  }
  validation_response: any = {
    success: [],
    failure: [],
    isSubmitted: false,
    disable: false
  }
  environment = environment;
  loginForm: FormGroup;
  constructor(private formBuilder: FormBuilder,
    private router: Router,
    private ActivatedRoute: ActivatedRoute,
    private AuthenticationService: AuthenticationService,) { }

  ngOnInit() {
    this.loginForm = this.formBuilder.group({
      email: ['', [Validators.required, Validators.email]],
      password: ['', Validators.required],
      confirm_password: ['', Validators.required],
      referral: ['']
    });
    this.ActivatedRoute.params.subscribe(params=>{
      if(params['referral'].length > 0){
        this.loginForm.controls.referral.setValue(params['referral']);
      }
    })
  }
  valdator(){
    return this.loginForm.controls;
  }
  onSubmitRegister(){
    if(this.valdator().confirm_password.value !== this.valdator().password.value){
      this.validation_response.failure.push('password does not match');
      this.validation_response.disable = false;
    }
    this.validation_response.failure = [];
    this.validation_response.success= [];
    this.validation_response.isSubmitted = false;
    if(this.loginForm.controls.email.invalid || this.loginForm.controls.password.invalid){
      this.validation_response.isSubmitted = true;
      alert('Please check email/password. password must be up to 6');
      return;
    }
    this.validation_response.disable = true;
    let formData = new FormData();
    formData.append('email', this.loginForm.controls.email.value);
    formData.append('password', this.loginForm.controls.password.value);
    if(this.loginForm.controls.referral.value.length > 0) {
      formData.append('referral', this.loginForm.controls.referral.value);
    }
    document.getElementById('submit').innerHTML='signing up';
    this.AuthenticationService.register(formData).subscribe(data=> {
      if(data['status'] !== '200'){
        this.validation_response.failure.push(data['response']);
        alert(data['response']);
        document.getElementById('submit').innerHTML='sign up';
        this.validation_response.disable = false;
      }else{
        this.tokenSetup(data);
        this.validation_response.success.push(data['response']);
      }
    });
  }
  tokenSetup(data){
    this.AuthenticationService.handle({token: data['access_token'], user: data['user']});
    return this.router.navigate(['authenticated/dashboard/analytics']);
  }
}
