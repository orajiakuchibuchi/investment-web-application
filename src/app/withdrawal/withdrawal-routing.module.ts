import { RequestComponent } from './request/request.component';
import { RequestsComponent } from './requests/requests.component';
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HistoryComponent } from './history/history.component';
import { AllHistoryComponent } from './all-history/all-history.component';


const routes: Routes = [
  {
    path: '',
    redirectTo: 'history',
    pathMatch: 'full'
  },
  {
    path: 'history',
    component: HistoryComponent
  },
  {
    path: 'history/all',
    component: AllHistoryComponent
  },
  {
    path: 'request',
    component: RequestComponent
  },
  {
    path: 'requests',
    component: RequestsComponent
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class WithdrawalRoutingModule { }
