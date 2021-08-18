import { BaseApiService } from 'src/app/services/base-api.service';
import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import { Router } from '@angular/router';

@Component({
  selector: 'app-eth',
  templateUrl: './eth.component.html',
  styleUrls: ['./eth.component.scss']
})
export class EthComponent implements OnInit {
  address: any = [];
  isAdding: boolean = false;
  submitLoader:boolean = false;
  validator_toast:any ={
    isSubmited: false,
    success:false,
    message: ''
  };
  addAddressForm: FormGroup;
  images: any = [];
  constructor(private BaseApiService:BaseApiService,
    private formBuilder: FormBuilder,
              private router: Router) { }

  ngOnInit() {
    this.BaseApiService.getEthAddress().subscribe(data=>{
      this.address = data;
    })
    this.addAddressForm = this.formBuilder.group({
      address: ['', Validators.required]
    });
  }
  validate(){
    return this.addAddressForm.controls;
  }
  onSubmit(){
    if(this.validate().address.valid){
      let formData = new FormData();
      formData.append('address', this.validate().address.value);
      this.BaseApiService.updateEthAddress(formData).subscribe(data=>{
        if(data['status'] == '200'){
          this.address = data['data'];
          this.isAdding = false;
        }else{
          alert(JSON.stringify(data['errors'], null, 4));
        }
      })
    }
  }
  paste(){
    navigator.clipboard.readText()
      .then(text => {
        console.log('Pasted content: ', text);
        this.validate().address.setValue(text);
      })
      .catch(err => {
        alert('Failed to read clipboard contents:' + JSON.stringify(err, null, 4));
        console.error('Failed to read clipboard contents: ', err);
      });
  }
  copy(){
    navigator.clipboard.writeText(this.address[0]['address'])
      .then(text => {
        alert('Copied address: ' + this.address[0]['address'])
      })
      .catch(err => {
        alert('Failed to copy contents to clipboard: ' + JSON.stringify(err, null, 4));
        console.error('Failed to read clipboard contents: ', err);
      });
  }
  delete(){
    let formData = new FormData();
    formData.append('address', this.address[0]['address']);
    this.BaseApiService.deleteEthAddress(formData).subscribe(data=>{
      if(data['status'] == '200'){
        this.address = [];
        this.isAdding = false;
      }else{
        alert(JSON.stringify(data['errors'], null, 4));
      }
    })
  }
  getTimeStamp(time){
    return new Date(time).toString();
  }

}
