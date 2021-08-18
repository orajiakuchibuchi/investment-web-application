import { BaseApiService } from 'src/app/services/base-api.service';
import { Component, OnInit } from '@angular/core';
@Component({
  selector: 'app-requests',
  templateUrl: './requests.component.html',
  styleUrls: ['./requests.component.scss']
})
export class RequestsComponent implements OnInit {
history: any = [];
  selectedInvestMent: any = [];
  submitLoader:boolean = false;
  constructor(private BaseApiService:BaseApiService) { }

  ngOnInit() {
    this.BaseApiService.withdrawalRequest().subscribe(data=>{
      this.history = data;
      // alert( JSON.stringify(data, null, 4))
    });
  }
  copy(val){
    navigator.clipboard.writeText(val)
      .then(text => {
        alert('Copied');
      })
      .catch(err => {
        alert('Failed to copy contents to clipboard: ' + JSON.stringify(err, null, 4));
        console.error('Failed to read clipboard contents: ', err);
      });
  }
  confirm(){
    let formData = new FormData();
    formData.append('oldpassword', document.getElementById('password')['value']);
    formData.append('id', this.selectedInvestMent.id);
    this.submitLoader = true;
    this.BaseApiService.approveWithdrawal(formData).subscribe(data=>{
      if(data['status'] == '200'){
        alert('Payment approved');
        window.location.reload();
      }
      else{
        alert(JSON.stringify(data['errors']));
        this.submitLoader = false;
      }
    })
  }
  decline(){
    let formData = new FormData();
    formData.append('oldpassword', document.getElementById('deletepassword')['value']);
    formData.append('id', this.selectedInvestMent.id);
    this.submitLoader = true;
    this.BaseApiService.declineWithdrawal(formData).subscribe(data=>{
      if(data['status'] == '200'){
        alert('Decline approved');
        window.location.reload();
      }
      else{
        alert(JSON.stringify(data['errors']));
        this.submitLoader = false;
      }
    })
  }
}
