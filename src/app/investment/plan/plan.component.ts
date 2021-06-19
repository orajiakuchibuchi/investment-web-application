import { BaseApiService } from 'src/app/services/base-api.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-plan',
  templateUrl: './plan.component.html',
  styleUrls: ['./plan.component.scss']
})
export class PlanComponent implements OnInit {
  plans: any = [];
  constructor(private BaseApiService:BaseApiService) { }

  ngOnInit() {
    this.BaseApiService.getAllPlans().subscribe(data=>{
      this.plans = data;
    });
  }

}
