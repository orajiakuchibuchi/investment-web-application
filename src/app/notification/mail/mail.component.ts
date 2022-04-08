import { BaseApiService } from 'src/app/services/base-api.service';
import { Component, OnInit } from '@angular/core';
import { AngularEditorConfig } from '@kolkov/angular-editor';

@Component({
  selector: 'app-mail',
  templateUrl: './mail.component.html',
  styleUrls: ['./mail.component.scss']
})
export class MailComponent implements OnInit {
  mails: any = [{
    subject: 'Email template',
    body: 'Here is the test body of this subject email. You can paste your email body here'
  }];
  submitLoader = false;
  bodyContent: any = '';
  selectedEmail: any = {id: null, subject: '', body: ''};
  editorConfig: AngularEditorConfig = {
    editable: true,
      spellcheck: true,
      height: 'auto',
      minHeight: '50',
      maxHeight: 'auto',
      width: 'auto',
      minWidth: '0',
      translate: 'yes',
      enableToolbar: true,
      showToolbar: true,
      placeholder: '',
      defaultParagraphSeparator: '',
      defaultFontName: '',
      defaultFontSize: '',
      fonts: [
        {class: 'arial', name: 'Arial'},
        {class: 'times-new-roman', name: 'Times New Roman'},
        {class: 'calibri', name: 'Calibri'},
        {class: 'comic-sans-ms', name: 'Comic Sans MS'}
      ],
      customClasses: [
        {
          name: 'quote',
          class: 'quote',
        },
        {
          name: 'redText',
          class: 'redText'
        },
        {
          name: 'titleText',
          class: 'titleText',
          tag: 'h1',
        },
      ],
    // uploadUrl: 'v1/image',
    // upload: (file: File) => { this.uploadFile(file) },
    // uploadWithCredentials: false,
    sanitize: true,
    toolbarPosition: 'top',
    toolbarHiddenButtons: [
      ['bold', 'italic'],
      ['fontSize']
    ]
  }

  constructor(private BaseApiService: BaseApiService) { }

  ngOnInit() {
  }
  viewEmail(id){
    this.selectedEmail = this.mails.find(x => x.id === id);
    this.bodyContent = this.selectedEmail.body;
  }
  uploadFile(file){
    return file
  }
  send(id){
    this.selectedEmail = this.mails.find(x => x.id === id);
    this.bodyContent = this.selectedEmail.body;
  }
  editEmail(id){

  }
  confirmSend(){
    // (<HTMLInputElement>document.getElementById("submitMail")).style.disable = "true";;
    let formData = new FormData();
    const email =  (<HTMLInputElement>document.getElementById("email")).value;
    const subject = this.selectedEmail.subject;
    const body = this.bodyContent;
    formData.append('email', email);
    formData.append('subject', subject);
    formData.append('body', body);
    this.BaseApiService.sendEmail(formData).subscribe((res) => {
      alert(res['response'] ? res['response'] : res['error']);
      return true;
    })
  }
}
