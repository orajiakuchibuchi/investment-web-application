import { AuthenticationService } from 'src/app/services/authentication.service';
import { BaseApiService } from 'src/app/services/base-api.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-record',
  templateUrl: './record.component.html',
  styleUrls: ['./record.component.scss']
})
export class RecordComponent implements OnInit {
  records: any = [];
  user: any = [];
  constructor(private BaseApiService:BaseApiService,private AuthenticationService:AuthenticationService) { }

  ngOnInit() {
    this.user = this.AuthenticationService.getUser()['user'];
    this.BaseApiService.getAdminAllPlans().subscribe(data=>{
        this.records = data['response'];
    })
  }

}
