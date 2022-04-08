import { Router } from '@angular/router';
import { BaseApiService } from 'src/app/services/base-api.service';
import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";


@Component({
  selector: 'app-request',
  templateUrl: './request.component.html',
  styleUrls: ['./request.component.scss']
})
export class RequestComponent implements OnInit {
  submitLoader:boolean = false;
  validator_toast:any ={
    isSubmited: false,
    success:false,
    message: ''
  };
  withdrawForm: FormGroup;
  plans:any = [];
  investments:any = [];
  images: any = [];
  message: any = '';
  apiRes:any = {status:null, response: ''}
  selectedInvestMent: any = null;
  plan: any = null;
  addresses: any = [];
  constructor(private BaseApiService: BaseApiService,
    private formBuilder: FormBuilder,
              private router: Router) { }

  ngOnInit() {
    this.withdrawForm = this.formBuilder.group({
      investment: ['', Validators.required],
      payment_method: ['', Validators.required],
      amount: ['', Validators.required],
      paying_address: ['', Validators.required]
    });
    this.BaseApiService.getAllWithdrawableInvestments().subscribe(data=>{
      this.investments = data;
    })
  }
  updateSeletedInvestMent(){
    const value = document.getElementById("invest")['value'];
    this.selectedInvestMent = this.investments.find(x=> x.id == value);
  }
  getRoi(){
    const roi =  parseInt(this.selectedInvestMent.amount) + ((parseInt(this.selectedInvestMent.plans.interest) / 100) * parseInt(this.selectedInvestMent.amount));
    this.validate().amount.setValue(roi);
    return roi;
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
    if(this.withdrawForm.valid){
      let formData = new FormData();
      formData.append('investment_id', this.validate().investment.value);
      formData.append('payment_method', this.validate().payment_method.value);
      formData.append('amount', this.validate().amount.value);
      formData.append('paying_address', this.validate().paying_address.value);
      this.submitLoader = true;
      this.BaseApiService.requestWithdrawal(formData).subscribe(data=>{
        // if(data['status'] == '200'){
        //   alert(data['response']);
        //   return this.router.navigate(['/authenticated/withdrawal/history']);
        // }else{
        //   alert(JSON.stringify(data['response'], null, 4));
        //   this.submitLoader = false;
        // }
        this.apiRes.status = true;
        this.submitLoader = false;
      })
    }else{
      alert('Please confirm form once again');
    }
  }
  validate(){
    return this.withdrawForm.controls;
  }
  withdrawalHistory(){
    return this.router.navigate(['/authenticated/withdrawal/history']);
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
}
