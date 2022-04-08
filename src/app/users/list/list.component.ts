import { BaseApiService } from './../../services/base-api.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-list',
  templateUrl: './list.component.html',
  styleUrls: ['./list.component.scss']
})
export class ListComponent implements OnInit {
  users:any;
  selected: string = '';
  submitLoader: boolean = false;
  constructor(private BaseApiService:BaseApiService) { }

  ngOnInit() {
    this.BaseApiService.getAllUsers().subscribe(data => {
      this.users = data;
    })
  }
  toggleStatus(email){
      this.BaseApiService.updateUserStatus(email).subscribe(data=>{
        alert(data);
        window.location.reload();
      })
  }
  confirm(){
    let formData = new FormData();
    formData.append('profit', document.getElementById('profit')['value']);
    formData.append('email', this.selected);
    this.submitLoader = true;
    this.BaseApiService.updateUserProfit(formData).subscribe(data=>{
      if(data['status'] == '200'){
        alert(data['response']);
        window.location.reload();
      }
      else{
        alert(data['response']);
        this.submitLoader = false;
      }
    })
  }
  getTimeStamp(time){
    return new Date(time).toString();
  }

}
