import { InvestComponent } from './invest/invest.component';
import { PlanComponent } from './plan/plan.component';
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HistoryComponent } from './history/history.component';
import { AllHistoryComponent } from './all-history/all-history.component';
import { RequestsComponent } from './requests/requests.component';

const routes: Routes = [
  {
    path: '',
    children: [
      {
        path: '',
        redirectTo: 'history',
        pathMatch: 'full'
      },
      {
        path: 'plans',
        component: PlanComponent
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
        path: 'requests',
        component: RequestsComponent
      },
      {
        path: 'invest',
        component: InvestComponent
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class InvestmentRoutingModule { }
