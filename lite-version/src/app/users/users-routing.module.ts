import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { InvestorsComponent } from './investors/investors.component';
import { ListComponent } from './list/list.component';


const routes: Routes = [
  {
    path: 'list',
    component: ListComponent
  },
  {
    path: 'investors',
    component: InvestorsComponent
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class UsersRoutingModule { }
