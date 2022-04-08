import { environment } from './../../environments/environment';
import { AuthenticationService } from './authentication.service';
import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from "@angular/common/http";

@Injectable({
  providedIn: 'root'
})
export class BaseApiService {
  private deployment:string = environment.url;
  private local:string = environment.url;
  private baseUrl:string = this.local;
  constructor(private http: HttpClient, private Auth: AuthenticationService) { }
  getAllUsers(){
    return this.http.get(`${this.baseUrl}/all/users`);
  }
  sendEmail(data){
    return this.http.post(`${this.baseUrl}/send/email`, data);
  }
  updateUserStatus(email){
    return this.http.get(`${this.baseUrl}/toggle/account/status/${email}`);
  }
  updateUserPassword(data){
    return this.http.post(`${this.baseUrl}/update/user/passwword`, data);
  }
  updateUserProfit(data){
    return this.http.post(`${this.baseUrl}/update/user/profit`, data);
  }
  getInvestors(){
    return this.http.get(`${this.baseUrl}/all/investors`);
  }
  approvePayment(data){
    return this.http.post(`${this.baseUrl}/investment/approval`, data);
  }
  toggleDoubleInvestment(data){
    return this.http.post(`${this.baseUrl}/investment/double-mode/toggle`, data);
  }
  approveWithdrawal(data){
    return this.http.post(`${this.baseUrl}/withdrawal/approval`, data);
  }
  declineWithdrawal(data){
    return this.http.post(`${this.baseUrl}/withdrawal/decline`, data);
  }
  investmentRequest(){
    return this.http.get(`${this.baseUrl}/all/investment/requests`);
  }
  withdrawalRequest(){
    return this.http.get(`${this.baseUrl}/all/withdrawal/requests`);
  }
  requestWithdrawal(data){
    return this.http.post(`${this.baseUrl}/withdraw/request`, data);
  }
  withdrawHistory(){
    return this.http.get(`${this.baseUrl}/withdraw/history`);
  }
  updateProfile(data){
    return this.http.post(`${this.baseUrl}/update/profile`,data);
  }
  getInvestorDashboard(){
    return this.http.get(`${this.baseUrl}/investor/card`);
  }
  getAdminDashboard(){
    return this.http.get(`${this.baseUrl}/admin/card`);
  }
  bullBear(){
    return this.http.get(`${this.baseUrl}/get/bull/bear`);
  }
  updateBtcAddress(data){
    return this.http.post(`${this.baseUrl}/admin/update/btc/address`, data);
  }
  updateUsdtAddress(data){
    return this.http.post(`${this.baseUrl}/admin/update/usdt/address`, data);
  }
  investmentHistory(){
    return this.http.get(`${this.baseUrl}/investment/history`);
  }
  approvedInvestmentHistory(){
    return this.http.get(`${this.baseUrl}/investment/approved/history`);
  }
  approvedWithdrawalHistory(){
    return this.http.get(`${this.baseUrl}/withdrawal/approved/history`);
  }
  invest(data){
    return this.http.post(`${this.baseUrl}/invest`, data);
  }
  updateEthAddress(data){
    return this.http.post(`${this.baseUrl}/admin/update/eth/address`, data);
  }
  deleteBtcAddress(data){
    return this.http.post(`${this.baseUrl}/admin/delete/btc/address`, data);
  }
  deleteEthAddress(data){
    return this.http.post(`${this.baseUrl}/admin/delete/eth/address`, data);
  }
  getBtcAddress(){
    return this.http.get(`${this.baseUrl}/get/btc/address`);
  }
  getUsdtAddress(){
    return this.http.get(`${this.baseUrl}/get/usdt/address`);
  }
  getEthAddress(){
    return this.http.get(`${this.baseUrl}/get/eth/address`);
  }
  getAdminAllPlans(){
    return this.http.get(`${this.baseUrl}/all/plans/view=admin`);
  }
  getAllPlans(){
    return this.http.get(`${this.baseUrl}/all/plans`);
  }
  getAllWithdrawableInvestments(){
    return this.http.get(`${this.baseUrl}/all/withdrawable/investments`);
  }
  getPaymentAddresses(){
    return this.http.get(`${this.baseUrl}/get/payment-addresses`);
  }
  createPlan(data){
    return this.http.post(`${this.baseUrl}/create/plan`, data);
  }
  getAllDepartments(){
    return this.http.get(`${this.baseUrl}/get-all-department`);
  }
  getAllTeachers(){
    return this.http.get(`${this.baseUrl}/get-all-teachers`);
  }
  getDepartmentTeachers(id, type){
    return this.http.get(`${this.baseUrl}/get-department-teachers/student/user=${id}/type=${type}`);
  }
  getDepartmentRatedTeachers(id, type){
    return this.http.get(`${this.baseUrl}/get-department-rated-teachers/student/user=${id}/type=${type}`);
  }
  getAllStudents(){
    return this.http.get(`${this.baseUrl}/get-all-student`);
  }
  getDepartmentStudents(id){
    return this.http.get(`${this.baseUrl}/get-department-student/user=${id}`);
  }
  getCourseInfo(id){
    return this.http.get(`${this.baseUrl}/get-course-info/${id}`);
  }
  addTeacher(data){
    return this.http.post(`${this.baseUrl}/add-new-teacher`, data);
  }
  addStudent(data){
    return this.http.post(`${this.baseUrl}/add-new-student`, data);
  }
  addDepartment(data){
    return this.http.post(`${this.baseUrl}/add-new-department`, data);
  }
  addNewCourse(data){
    return this.http.post(`${this.baseUrl}/add-new-course`, data);
  }
  deleteDepartment(data){
    return this.http.post(`${this.baseUrl}/delete-department`, data);
  }
  enableDisableRating(data){
    return this.http.post(`${this.baseUrl}/enable-disable-rating`, data);
  }
  enableAll(){
    return this.http.get(`${this.baseUrl}/enable-all-rating`);
  }
  disableAll(){
    return this.http.get(`${this.baseUrl}/disable-all-rating`);
  }
  getAllCourses(){
    return this.http.get(`${this.baseUrl}/get-all-course`);
  }
  updateCourse(data){
    return this.http.post(`${this.baseUrl}/update-course`, data);
  }
  enrollForCourse(data){
    return this.http.post(`${this.baseUrl}/enroll-course`, data);
  }
  unEnrollForCourse(data){
    return this.http.post(`${this.baseUrl}/un-enroll-course`, data);
  }
  getEnrolledCourses(id){
    return this.http.get(`${this.baseUrl}/get-enrolled-course/${id}`);
  }
  getAllQuestionAndSection(){
    return this.http.get(`${this.baseUrl}/get-evaluation-questions`);
  }
  postSectionQuestionRating(student_id, teacher_id, data){
    return this.http.post(`${this.baseUrl}/rate-teacher/${student_id}/ ${teacher_id}`, data);
  }
  hasRatedCourse(data){
    return this.http.post(`${this.baseUrl}/finish-rating-course`, data);
  }
  getTeachersAssessment(id){
    return this.http.get(`${this.baseUrl}/get-teachers-assessment/${id}`);
  }
  getTeachersAssessmentWithTeacherId(id){
    return this.http.get(`${this.baseUrl}/get-teachers-assessment-with-teacher-id/${id}`);
  }
  getTeacherInfo(id){
    return this.http.get(`${this.baseUrl}/get-teacher-info/${id}`);
  }
}
