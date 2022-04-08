import { Router } from '@angular/router';
import { environment } from './../../../../environments/environment';
import { BaseApiService } from 'src/app/services/base-api.service';
import { AuthenticationService } from 'src/app/services/authentication.service';
import { Component, OnInit } from '@angular/core';
import { ChartDB } from '../../../fack-db/chart-data';
import {ApexChartService} from '../../../theme/shared/components/chart/apex-chart/apex-chart.service';

@Component({
  selector: 'app-dash-analytics',
  templateUrl: './dash-analytics.component.html',
  styleUrls: ['./dash-analytics.component.scss']
})
export class DashAnalyticsComponent implements OnInit {
  public chartDB: any;
  public dailyVisitorStatus: string;
  public dailyVisitorAxis: any;
  public deviceProgressBar: any;
  bullBear:any = [];
  user: any = [];
  env = environment;
  card: any = [];
  submitLoader: boolean = false;
  topInvestorsReferrals = [
    {code: 'D30CFA', count: 12},
    {code: 'V3oeSF', count: 9},
    {code: 'PRDRSS', count: 15},
    {code: 'OP3eds', count: 8},
    {code: 'KR4kds', count: 9},
    {code: 'oW3dna', count: 13},
    {code: 'weC32x', count: 21},
    {code: 'ce3Ses', count: 15},
    {code: 'pq3d23', count: 12},
    {code: 'weSwrs', count: 12},
    {code: 'nf4jde', count: 9},
    {code: 'fdd3dn', count: 10},
    {code: 'oe392e', count: 19},
    {code: 'nr39nd', count: 18},
    {code: 'oesdfe', count: 9},
    {code: 'jdke32', count: 10},
  ]
  constructor(public apexEvent: ApexChartService,
     private AuthenticationService: AuthenticationService,
     private BaseApiService: BaseApiService,
     private Router: Router) {
    this.chartDB = ChartDB;
    this.dailyVisitorStatus = '1y';

    this.deviceProgressBar = [
      {
        type: 'success',
        value: 66
      }, {
        type: 'primary',
        value: 26
      }, {
        type: 'danger',
        value: 8
      }
    ];
  }

  ngOnInit() {
    this.BaseApiService.bullBear().subscribe(data=>{
      this.bullBear = data;
      // alert(JSON.stringify(data,null, 4))
    })
    this.user = this.AuthenticationService.getUser()['user'];
    if(this.user.role == '2'){
      this.BaseApiService.getInvestorDashboard().subscribe(data=>{
        this.card = data;
        // alert(JSON.stringify(this.card,null, 4));
      });
    }else if(this.user.role == '1'){
      this.BaseApiService.getAdminDashboard().subscribe(data=>{
        this.card = data;
      });
    }
    this.shuffle(this.topInvestorsReferrals, true);
    setInterval(()=>{
      this.shuffle(this.bullBear);
      // this.shuffle(this.topInvestorsReferrals, true);
    },5000);
  }
  manageUserAccount(){
    return this.Router.navigate(['/authenticated/users/list']);
  }
  shortcut(value){
    if(value==='investment'){
      return this.Router.navigate(['/authenticated/investment/requests']);
    }else if(value ==='withdrawal'){
      return this.Router.navigate(['/authenticated/withdrawal/requests']);
    }else if(value==='investment_c'){
      return this.Router.navigate(['/authenticated/investment/invest']);
    }else if(value==='withdrawal_c'){
      return this.Router.navigate(['/authenticated/withdrawal/request']);
    }else if(value==='plans'){
      return this.Router.navigate(['/authenticated/investment/plans']);
    }else if(value==='profile'){
      return this.Router.navigate(['/authenticated/account/profile']);
    }
  }
  updateUserPassword(){
    let formData = new FormData();
    formData.append('email', document.getElementById('email')['value']);
    formData.append('password', document.getElementById('update_password')['value']);
    this.submitLoader = true;
    this.BaseApiService.updateUserPassword(formData).subscribe(data=>{
      if(data['status'] == '200'){
        alert(data['response']);
        // window.location.reload();
      }
      else{
        alert(data['response']);
      }
      this.submitLoader = false;
    })
  }
  confirm(){
    let formData = new FormData();
    formData.append('password', document.getElementById('password')['value']);
    this.submitLoader = true;
    this.BaseApiService.toggleDoubleInvestment(formData).subscribe(data=>{
      if(data['status'] == '200'){
        alert(data['response']);
        window.location.reload();
      }
      else{
        alert(JSON.stringify(data['errors']));
        this.submitLoader = false;
      }
    })
  }
  copyLinkAddress(){
    let address = this.env.website + "auth/signup/" + this.user.referral_code;
    navigator.clipboard.writeText(address)
      .then(text => {
        alert('Link Copied to clipboard.');
      })
      .catch(err => {
        alert('Failed to copy contents to clipboard\n' +'Your link is: '+ address);
      });
  }
  pars(num){
    return parseInt(num);
  }
  shuffle(array, type=null) {
    var currentIndex = array.length,  randomIndex;
    // While there remain elements to shuffle...
    while (0 !== currentIndex) {
      // Pick a remaining element...
      randomIndex = Math.floor(Math.random() * currentIndex);
      currentIndex--;
      // And swap it with the current element.
      [array[currentIndex], array[randomIndex]] = [array[randomIndex], array[currentIndex]];
    }
    if(type){
      array.sort((a, b) => a.count - b.count);
    }
  }

}
