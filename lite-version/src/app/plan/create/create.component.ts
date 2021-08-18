import { BaseApiService } from 'src/app/services/base-api.service';
import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import { Router } from '@angular/router';

@Component({
  selector: 'app-create',
  templateUrl: './create.component.html',
  styleUrls: ['./create.component.scss']
})
export class CreateComponent implements OnInit {
  submitLoader:boolean = false;
  validator_toast:any ={
    isSubmited: false,
    success:false,
    message: ''
  };
  addPlanForm: FormGroup;
  images: any = [];
  constructor(private BaseApiService:BaseApiService,
    private formBuilder: FormBuilder,
              private router: Router) { }
  message: any = '';
  ngOnInit() {
    this.addPlanForm = this.formBuilder.group({
      name: ['', Validators.required],
      min_amount: ['', [Validators.required, Validators.min(0)]],
      max_amount: ['', [Validators.required, Validators.min(0)]],
      interest: ['', [Validators.required, Validators.min(0)]],
      maturity: ['', [Validators.required, Validators.min(1)]]
    });
  }
  validator(){
    return this.addPlanForm.controls;
  }
  onSubmit(){
    if(this.addPlanForm.valid){
      let formData = new FormData();
      formData.append('name', this.validator().name.value);
      formData.append('min_amount', this.validator().min_amount.value);
      formData.append('max_amount', this.validator().max_amount.value);
      formData.append('interest', this.validator().interest.value);
      formData.append('maturity', this.validator().maturity.value);
      this.BaseApiService.createPlan(formData).subscribe(data=>{
        if(data['status'] == '200'){
          alert(data['response']);
          return this.router.navigate(['authenticated/plan/record']);
        }else{
          alert(JSON.stringify(data['response'], null, 4));
        }
      })
    }
  }

}
