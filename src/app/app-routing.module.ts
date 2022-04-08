import { MailComponent } from './notification/mail/mail.component';
import { MailViewComponent } from './notification/mail-view/mail-view.component';
import { MailEditComponent } from './notification/mail-edit/mail-edit.component';
import { AfterLoginGuard } from './guards/after-login.guard';
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AdminComponent } from './theme/layout/admin/admin.component';
import {AuthComponent} from './theme/layout/auth/auth.component';
import { BeforeLoginGuard } from './guards/before-login.guard';
import { from } from 'rxjs';
import { InvestorsComponent } from './users/investors/investors.component';
const routes: Routes = [
  {
    path: '',
    component: AuthComponent,
    children: [
      {
        path: '',
        redirectTo: 'auth/signin',
        pathMatch: 'full'
      },
      {
        path: 'auth',
        loadChildren: () => import('./demo/pages/authentication/authentication.module').then(module => module.AuthenticationModule)
      },
      {
        path: 'maintenance',
        loadChildren: () => import('./demo/pages/maintenance/maintenance.module').then(module => module.MaintenanceModule)
      }
    ]
  },
  {
    path: 'authenticated',
    component: AdminComponent,
    children: [
      {
        path: '',
        redirectTo: 'dashboard/analytics',
        pathMatch: 'full'
      },
      {
        path: 'investment',
        loadChildren: () => import('./investment/investment.module').then(module => module.InvestmentModule)
      },
      {
        path: 'investor/record/manager',
        component: InvestorsComponent
      },
      {
        path: 'mail',
        component: MailComponent
      },
      {
        path: 'mail/id={id}/edit',
        component: MailEditComponent
      },
      {
        path: 'mail/id={id}/view',
        component: MailViewComponent
      },
      {
        path: 'withdrawal',
        loadChildren: () => import('./withdrawal/withdrawal.module').then(module => module.WithdrawalModule)
      },
      {
        path: 'plan',
        loadChildren: () => import('./plan/plan.module').then(module => module.PlanModule)
      },
      {
        path: 'users',
        loadChildren: () => import('./users/users.module').then(module => module.UsersModule)
      },
      {
        path: 'account',
        loadChildren: () => import('./account/account.module').then(module => module.AccountModule)
      },
      {
        path: 'dashboard',
        loadChildren: () => import('./demo/dashboard/dashboard.module').then(module => module.DashboardModule)
      },
      {
        path: 'maintenance',
        loadChildren: () => import('./demo/pages/maintenance/maintenance.module').then(module => module.MaintenanceModule)
      }
    ]
  },
  {
    path: '',
    component: AuthComponent,
    children: [
      {
        path: 'maintenance',
        loadChildren: () => import('./demo/pages/maintenance/maintenance.module').then(module => module.MaintenanceModule)
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
