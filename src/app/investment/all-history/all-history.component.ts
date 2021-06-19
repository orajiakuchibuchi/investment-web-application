import { BaseApiService } from 'src/app/services/base-api.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-all-history',
  templateUrl: './all-history.component.html',
  styleUrls: ['./all-history.component.scss']
})
export class AllHistoryComponent implements OnInit {
  history: any = [];
  constructor(private BaseApiService:BaseApiService) { }

  ngOnInit() {
    this.BaseApiService.approvedInvestmentHistory().subscribe(data=>{
      this.history = data;
    });
  }
}
