import { SharedModule } from './../theme/shared/shared.module';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { InvestmentRoutingModule } from './investment-routing.module';
import { InvestmentComponent } from './investment.component';
import { PlanComponent } from './plan/plan.component';
import { InvestComponent } from './invest/invest.component';
import { HistoryComponent } from './history/history.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { RequestsComponent } from './requests/requests.component';
import { AllHistoryComponent } from './all-history/all-history.component';
import { SearchRecordComponent } from './search-record/search-record.component';


@NgModule({
  declarations: [InvestmentComponent, PlanComponent, InvestComponent, HistoryComponent, RequestsComponent, AllHistoryComponent, SearchRecordComponent],
  imports: [
    CommonModule,
    InvestmentRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    SharedModule
  ]
})
export class InvestmentModule { }
