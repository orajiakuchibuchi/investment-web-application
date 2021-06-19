import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { AccountRoutingModule } from './account-routing.module';
import { AccountComponent } from './account.component';
import { ProfileComponent } from './profile/profile.component';
import { BtcComponent } from './btc/btc.component';
import { EthComponent } from './eth/eth.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { SharedModule } from './../theme/shared/shared.module';
import { UsdtComponent } from './usdt/usdt.component';

@NgModule({
  declarations: [AccountComponent, ProfileComponent, BtcComponent, EthComponent, UsdtComponent],
  imports: [
    CommonModule,
    AccountRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    SharedModule
  ]
})
export class AccountModule { }
