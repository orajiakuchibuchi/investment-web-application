import { BaseApiService } from './../../services/base-api.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-investors',
  templateUrl: './investors.component.html',
  styleUrls: ['./investors.component.scss']
})
export class InvestorsComponent implements OnInit {
  investors:any;
  constructor(private BaseApiService:BaseApiService) { }

  ngOnInit() {
    this.BaseApiService.getInvestors().subscribe(data => {
      this.investors = data;
    })
  }
  getTimeStamp(time){
    return new Date(time).toLocaleString();
  }
}
