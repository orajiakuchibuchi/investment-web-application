import { BaseApiService } from 'src/app/services/base-api.service';
import { Component, OnInit } from '@angular/core';
import { ChangeDetectorRef } from '@angular/core';

@Component({
  selector: 'app-history',
  templateUrl: './history.component.html',
  styleUrls: ['./history.component.scss']
})
export class HistoryComponent implements OnInit {

  history: any = [];
  constructor(private BaseApiService:BaseApiService,
              private cdref: ChangeDetectorRef) { }

  ngOnInit() {
    this.BaseApiService.withdrawHistory().subscribe(data=>{
      this.history = data;
      // console.log(this.history);
      // alert(JSON.stringify(data, null, 4))
    });
  }
  getTimeStamp(time){
    return new Date(time).toString();
  }

  public generateRandomNumber(min, max) {
    return Math.floor(Math.random() * (max - min) + min);
  };
}
