import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SharedModule } from './../theme/shared/shared.module';

import { WithdrawalRoutingModule } from './withdrawal-routing.module';
import { WithdrawalComponent } from './withdrawal.component';
import { RequestComponent } from './request/request.component';
import { HistoryComponent } from './history/history.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { RequestsComponent } from './requests/requests.component';
import { AllHistoryComponent } from './all-history/all-history.component';


@NgModule({
  declarations: [WithdrawalComponent, RequestComponent, HistoryComponent, RequestsComponent, AllHistoryComponent],
  imports: [
    CommonModule,
    WithdrawalRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    SharedModule
  ]
})
export class WithdrawalModule { }
