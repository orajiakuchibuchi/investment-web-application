import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { PlanRoutingModule } from './plan-routing.module';
import { PlanComponent } from './plan.component';
import { CreateComponent } from './create/create.component';
import { RecordComponent } from './record/record.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { SharedModule } from './../theme/shared/shared.module';


@NgModule({
  declarations: [PlanComponent, CreateComponent, RecordComponent],
  imports: [
    CommonModule,
    PlanRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    SharedModule
  ]
})
export class PlanModule { }
