import { UsdtComponent } from './usdt/usdt.component';
import { BtcComponent } from './btc/btc.component';
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { EthComponent } from './eth/eth.component';
import { ProfileComponent } from './profile/profile.component';


const routes: Routes = [
  {
    path: 'profile',
    component: ProfileComponent
  },
  {
    path: 'btc',
    component: BtcComponent
  },
  {
    path: 'eth',
    component: EthComponent
  },
  {
    path: 'usdt',
    component: UsdtComponent
  }
];
@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AccountRoutingModule { }
