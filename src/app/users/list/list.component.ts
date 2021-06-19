import { BaseApiService } from './../../services/base-api.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-list',
  templateUrl: './list.component.html',
  styleUrls: ['./list.component.scss']
})
export class ListComponent implements OnInit {
  users:any;
  constructor(private BaseApiService:BaseApiService) { }

  ngOnInit() {
    this.BaseApiService.getAllUsers().subscribe(data => {
      this.users = data;
    })
  }
  getTimeStamp(time){
    return new Date(time).toString();
  }

}
