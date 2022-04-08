import { Router } from '@angular/router';
import { BaseApiService } from 'src/app/services/base-api.service';
import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";

@Component({
  selector: 'app-invest',
  templateUrl: './invest.component.html',
  styleUrls: ['./invest.component.scss']
})
export class InvestComponent implements OnInit {
  submitLoader:boolean = false;
  validator_toast:any ={
    isSubmited: false,
    success:false,
    message: ''
  };
  apiRes:any = {
    status: null,
    response: ''
  };
  investForm: FormGroup;
  plans:any = [];
  images: any = [];
  message: any = '';
  plan: any = null;
  addresses: any = [];
  constructor(private BaseApiService: BaseApiService,
    private formBuilder: FormBuilder,
              private router: Router) { }

  ngOnInit() {
    this.investForm = this.formBuilder.group({
      plan: ['', Validators.required],
      address: ['', Validators.required],
      amount: ['', Validators.required],
      paying_address: ['', Validators.required]
    });
    this.BaseApiService.getAllPlans().subscribe(data=>{
      this.plans = data;
    });
    this.BaseApiService.getPaymentAddresses().subscribe(data=>{
      this.addresses = data;
    })
  }
  selectPlan(){
    const value = document.getElementById("plan")['value'];
    this.plan = this.plans.find(x=> x.id == value);
    if(this.plan){
      this.validate().amount.setValidators([Validators.min(this.plan.min_amount), Validators.max(this.plan.max_amount)]);
    }
  }
  copy(){
    navigator.clipboard.writeText(this.validate().address.value)
      .then(text => {
        alert('Copied');
      })
      .catch(err => {
        alert('Failed to copy contents to clipboard: ' + JSON.stringify(err, null, 4));
        console.error('Failed to read clipboard contents: ', err);
      });
  }
  onSubmit(){
    if(this.investForm.valid){
      let formData = new FormData();
      let type = this.addresses.find(x => x.address == this.validate().address.value).coin;
      formData.append('plan_id', this.validate().plan.value);
      formData.append('address', this.validate().address.value);
      formData.append('type', type);
      formData.append('amount', this.validate().amount.value);
      formData.append('paying_address', this.validate().paying_address.value);
      this.submitLoader = true;
      this.BaseApiService.invest(formData).subscribe(data=>{
        if(data['status'] == '200'){
          // return this.router.navigate(['/authenticated/investment/history']);
          this.apiRes.status = true;
        }else{
          alert(JSON.stringify(data['errors'], null, 4));
          this.submitLoader = false;
        }
      })
    }else{
      alert('Please confirm form once again');
    }
  }
  validate(){
    return this.investForm.controls;
  }
  paste(){
    navigator.clipboard.readText()
      .then(text => {
        console.log('Pasted content: ', text);
        this.validate().paying_address.setValue(text);
      })
      .catch(err => {
        alert('Failed to read clipboard contents:' + JSON.stringify(err, null, 4));
        console.error('Failed to read clipboard contents: ', err);
      });
  }
  investmentHistory(){
    return this.router.navigate(['/authenticated/investment/history']);
  }
}
