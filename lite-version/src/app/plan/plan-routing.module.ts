import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { CreateComponent } from './create/create.component';
import { RecordComponent } from './record/record.component';


const routes: Routes = [
  {
    path: 'create',
    component: CreateComponent
  },
  {
    path: 'record',
    component: RecordComponent
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class PlanRoutingModule { }
