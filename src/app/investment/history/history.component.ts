import { BaseApiService } from 'src/app/services/base-api.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-history',
  templateUrl: './history.component.html',
  styleUrls: ['./history.component.scss']
})
export class HistoryComponent implements OnInit {
  history: any = [];
  constructor(private BaseApiService:BaseApiService) { }

  ngOnInit() {
    this.BaseApiService.investmentHistory().subscribe(data=>{
      this.history = data;
      // alert(JSON.stringify(data, null, 4))
    });
  }

}
