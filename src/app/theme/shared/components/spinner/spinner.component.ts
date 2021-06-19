import { SkeletonService } from './../../../../services/skeleton.service';
import {Component, Input, OnDestroy, Inject, ViewEncapsulation} from '@angular/core';
import {Spinkit} from './spinkits';
import {Router, NavigationStart, NavigationEnd, NavigationCancel, NavigationError} from '@angular/router';
import {DOCUMENT} from '@angular/common';

@Component({
    selector: 'app-spinner',
    templateUrl: './spinner.component.html',
    styleUrls: [
        './spinner.component.scss',
        './spinkit-css/sk-line-material.scss'
    ],
    encapsulation: ViewEncapsulation.None
})
export class SpinnerComponent implements OnDestroy {
    public isSpinnerVisible = false;
    public Spinkit = Spinkit;
    @Input() public backgroundColor = '#000000';
    @Input() public spinner = Spinkit.skLine;
    constructor(private router: Router,
      @Inject(DOCUMENT) private document: Document, private SkeletonService: SkeletonService) {
        this.router.events.subscribe(event => {
            if (event instanceof NavigationStart) {
                this.SkeletonService.showLoader().subscribe(value=>{
                  this.isSpinnerVisible = value;
                });
            } else if ( event instanceof NavigationEnd || event instanceof NavigationCancel || event instanceof NavigationError) {
                this.SkeletonService.turnOffLoader().subscribe(value=>{
                  this.isSpinnerVisible = value;
                });
            }
        }, () => {
          this.SkeletonService.turnOffLoader().subscribe(value=>{
            this.isSpinnerVisible = value;
          });
        });
    }
    ngOnDestroy(): void {
      this.SkeletonService.turnOffLoader().subscribe(value=>{
        this.isSpinnerVisible = value;
      });
    }
}
