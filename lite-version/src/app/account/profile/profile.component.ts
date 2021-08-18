import { Router } from '@angular/router';
import { BaseApiService } from 'src/app/services/base-api.service';
import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import { AuthenticationService } from 'src/app/services/authentication.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.scss']
})
export class ProfileComponent implements OnInit {
  profileForm:FormGroup;
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
  user: any = [];
  constructor(private formBuilder: FormBuilder,
    private router: Router,
    private AuthenticationService: AuthenticationService,
    private BaseApiService:BaseApiService) { }

  ngOnInit() {
    this.user = this.AuthenticationService.getUser()['user'];
    this.profileForm = this.formBuilder.group({
      email: [this.user.email, [Validators.required, Validators.email]],
      password: [''],
      oldpassword: ['', Validators.required],
      confirm_password: ['']
    });
  }
  addingPassword(){
    if(this.valdator().password.value.length > 1){
      this.valdator().password.setValidators(Validators.minLength(6));
      this.valdator().password.setValidators(Validators.required);
      this.valdator().confirm_password.setValidators(Validators.minLength(6));
      this.valdator().confirm_password.setValidators(Validators.required);
    }else{
      this.valdator().password.clearValidators();
      this.valdator().confirm_password.clearValidators();
    }
  }
  valdator(){
    return this.profileForm.controls;
  }
  onSubmit(){
    if(this.valdator().confirm_password.value !== this.valdator().password.value){
      this.validation_response.failure.push('password does not match');
      this.validation_response.disable = false;
    }
    this.validation_response.failure = [];
    this.validation_response.success= [];
    this.validation_response.isSubmitted = false;
    if(this.profileForm.controls.email.invalid || this.profileForm.controls.password.invalid){
      this.validation_response.isSubmitted = true;
      return;
    }
    this.validation_response.disable = true;
    let formData = new FormData();
    formData.append('email', this.profileForm.controls.email.value);
    formData.append('oldpassword', this.profileForm.controls.oldpassword.value);
    if(this.valdator().password.valid && this.valdator().password.value.length > 5){
      formData.append('password', this.profileForm.controls.password.value);
    }
    this.BaseApiService.updateProfile(formData).subscribe(data=> {
      if(data['status'] !== '200'){
        alert(JSON.stringify(data['errors']));
        this.validation_response.failure.push(data['response']);
        this.validation_response.disable = false;
      }else{
        alert(JSON.stringify(data['response']) + ' You will be signed out.');
        return this.router.navigate(['']);
      }
    });
  }
  tokenSetup(data){
    this.AuthenticationService.handle({token: data['access_token'], user: data['user']});
    return this.router.navigate(['authenticated/dashboard/analytics']);
  }
}
