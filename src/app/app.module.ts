import { ErrorInterceptor } from './../interceptors/ErrorInterceptor';
// import { InvestorsComponent } from './users/investors/investors.component';
import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { SharedModule } from './theme/shared/shared.module';
import { UsersModule } from './users/users.module';
import { AppComponent } from './app.component';
import { AdminComponent } from './theme/layout/admin/admin.component';
import { AuthComponent } from './theme/layout/auth/auth.component';
import { NavigationComponent } from './theme/layout/admin/navigation/navigation.component';
import { NavContentComponent } from './theme/layout/admin/navigation/nav-content/nav-content.component';
import { NavGroupComponent } from './theme/layout/admin/navigation/nav-content/nav-group/nav-group.component';
import { NavCollapseComponent } from './theme/layout/admin/navigation/nav-content/nav-collapse/nav-collapse.component';
import { NavItemComponent } from './theme/layout/admin/navigation/nav-content/nav-item/nav-item.component';
import { NavBarComponent } from './theme/layout/admin/nav-bar/nav-bar.component';
import { NavLeftComponent } from './theme/layout/admin/nav-bar/nav-left/nav-left.component';
import { NavSearchComponent } from './theme/layout/admin/nav-bar/nav-left/nav-search/nav-search.component';
import { NavRightComponent } from './theme/layout/admin/nav-bar/nav-right/nav-right.component';
import { ConfigurationComponent } from './theme/layout/admin/configuration/configuration.component';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { ToggleFullScreenDirective } from './theme/shared/full-screen/toggle-full-screen';
import { HeaderInterceptor } from '../interceptors/HeaderInterceptor';
import { WINDOW } from '@ng-toolkit/universal';

/* Menu Items */
import { NavigationItem } from './theme/layout/admin/navigation/navigation';
import { NgbButtonsModule, NgbDropdownModule, NgbTabsetModule, NgbTooltipModule } from '@ng-bootstrap/ng-bootstrap';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import {NgbPopoverModule } from '@ng-bootstrap/ng-bootstrap';
import { ManageAccountComponent } from './manage-account/manage-account.component';
import { MailComponent } from './notification/mail/mail.component';
import { AngularEditorModule } from '@kolkov/angular-editor';
import { MailEditComponent } from './notification/mail-edit/mail-edit.component';
import { MailViewComponent } from './notification/mail-view/mail-view.component';
@NgModule({
  declarations: [
    AppComponent,
    AdminComponent,
    AuthComponent,
    NavigationComponent,
    NavContentComponent,
    NavGroupComponent,
    NavCollapseComponent,
    NavItemComponent,
    NavBarComponent,
    NavLeftComponent,
    NavSearchComponent,
    // InvestorsComponent,
    NavRightComponent,
    ConfigurationComponent,
    ToggleFullScreenDirective,
    ManageAccountComponent,
    MailComponent,
    MailEditComponent,
    MailViewComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    SharedModule,
    NgbDropdownModule,
    NgbTooltipModule,
    NgbButtonsModule,
    HttpClientModule,
    NgbTabsetModule,
    UsersModule,
    FormsModule,
    ReactiveFormsModule,
    NgbPopoverModule,
    NgbTooltipModule,
    AngularEditorModule
  ],
  providers: [NavigationItem,
    {provide: WINDOW, useValue: {}},
    { provide: HTTP_INTERCEPTORS, useClass: HeaderInterceptor, multi: true },
    { provide: HTTP_INTERCEPTORS, useClass: ErrorInterceptor, multi: true },
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
