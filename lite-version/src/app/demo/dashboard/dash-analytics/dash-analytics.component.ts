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
  card: any = [];
  submitLoader: boolean = false;
  constructor(public apexEvent: ApexChartService,
     private AuthenticationService: AuthenticationService,
     private BaseApiService: BaseApiService) {
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
    setInterval(()=>{
      this.shuffle(this.bullBear);
    },5000);
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
  pars(num){
    return parseInt(num);
  }
  shuffle(array) {
    var currentIndex = array.length,  randomIndex;
    // While there remain elements to shuffle...
    while (0 !== currentIndex) {
      // Pick a remaining element...
      randomIndex = Math.floor(Math.random() * currentIndex);
      currentIndex--;
      // And swap it with the current element.
      [array[currentIndex], array[randomIndex]] = [array[randomIndex], array[currentIndex]];
    }
  }

}
