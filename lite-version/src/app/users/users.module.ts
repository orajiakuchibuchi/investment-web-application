import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { UsersRoutingModule } from './users-routing.module';
import { UsersComponent } from './users.component';
import { ListComponent } from './list/list.component';
import { InvestorsComponent } from './investors/investors.component';
import { SharedModule } from './../theme/shared/shared.module';


@NgModule({
  declarations: [UsersComponent, ListComponent, InvestorsComponent],
  imports: [
    CommonModule,
    UsersRoutingModule,
    SharedModule
  ]
})
export class UsersModule { }
