<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {
    Route::post('register', 'AuthController@register');
    // Route::post('store-owner-registration', 'AuthController@registerStoreOwner');
    // Route::post('update-changed-password', 'AuthController@changePassword');
    Route::post('login', 'AuthController@login');
    // Route::post('logout', 'AuthController@logout');
    Route::get('sign-out', 'AuthController@logout');
    Route::get('reset-password/{email}', 'AuthController@resetPassword');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    // Route::get('session/get','AuthController@accessSessionData');
    // Route::get('session/set','AuthController@storeSessionData');
    // Route::get('session/remove','AuthController@deleteSessionData');
});


Route::group([
    'middleware' => ['api','access_token'],
], function () {
    Route::get('all/users', 'Controller@getAllUsers');
    Route::get('all/users', 'Controller@getAllUsers');
    Route::get('all/investors', 'Controller@getAllInvestors');
    Route::get('all/investment/requests', 'Controller@investmentRequests');
    Route::get('all/withdrawal/requests', 'Controller@withdrawalRequests');
    Route::get('investment/approved/history', 'PlanController@approvedInvestment');
    Route::get('withdrawal/approved/history', 'PlanController@approvedWithdrawal');
    Route::get('all/plans/view=admin', 'PlanController@allPlansAdmin');
    Route::get('all/plans', 'PlanController@allPlans');
    Route::post('update/profile', 'Controller@updateProfile');
    Route::post('investment/approval', 'Controller@approveInvestment');
    Route::post('withdrawal/approval', 'Controller@approveWithdrawal');
    Route::post('withdrawal/decline', 'Controller@declineWithdrawal');
    Route::post('investment/double-mode/toggle', 'Controller@toggleInvestment');
    Route::post('update/user/profit', 'Controller@updateProfit');
    Route::post('withdraw/request', 'PlanController@withdrawRequest');
    Route::get('all/withdrawable/investments', 'PlanController@withdrawableInvest');
    Route::get('get/payment-addresses', 'AddressController@paymentAddresses');
    Route::get('get/bull/bear', 'Controller@bullBear');
    Route::get('investor/card', 'Controller@investorCard');
    Route::get('admin/card', 'Controller@adminCard');
    Route::get('investment/history', 'PlanController@investmentHistory');
    Route::get('withdraw/history', 'PlanController@withdrawHistory');
    Route::post('invest', 'PlanController@invest');
    Route::post('create/plan', 'PlanController@create');
    Route::post('admin/update/btc/address', 'AddressController@updateBTCAdress');
    Route::post('admin/update/eth/address', 'AddressController@updateETHAdress');
    Route::post('admin/update/usdt/address', 'AddressController@updateUSDTAdress');
    Route::post('admin/delete/btc/address', 'AddressController@deleteBTCAdress');
    Route::post('admin/delete/usdt/address', 'AddressController@deleteUSDTAdress');
    Route::post('admin/delete/eth/address', 'AddressController@deleteETHAddress');
    Route::get('get/btc/address', 'AddressController@getBTCAddress');
    Route::get('get/eth/address', 'AddressController@getETHAddress');
    Route::get('get-all-sections', 'Controller@fetchAllSections');
    Route::get('get-all-section-question', 'Controller@fetSectionAndQuestions');
    Route::get('get-evaluation-questions', 'Controller@fetchEvaluationQuestions');
    Route::get('get-all-department', 'Controller@fetchAllDepatments');
    Route::get('get-all-teachers', 'Controller@getAllTeachers');
    Route::get('get-department-teachers/student/user={id}/type={type}', 'Controller@getDepartmentTeachers');
    Route::get('get-department-rated-teachers/student/user={id}/type={type}', 'Controller@getRatedDepartmentTeachers');
    Route::get('get-all-student', 'Controller@getAllStudents');
    Route::get('get-department-student/user={id}', 'Controller@getDepartmentStudents');
    Route::get('get-course-info/{course_code}', 'Controller@getCourseInfo');
    Route::get('get-teacher-info/{id}', 'Controller@getTeacherInfo');
    Route::post('add-new-teacher', 'Controller@addNewTeacher');
    Route::post('add-new-student', 'Controller@addNewStudent');
    Route::post('add-new-department', 'Controller@addNewDepartment');
    Route::post('add-new-course', 'Controller@addNewCourse');
    Route::post('rate-teacher/{student_id}/{teacher_id}', 'Controller@rateTeacher');
    Route::post('delete-department', 'Controller@deleteDepartment');
    Route::post('enable-disable-rating', 'Controller@enableDisableRating');
    Route::post('update-course', 'Controller@updateCourse');
    Route::post('enroll-course', 'Controller@enrollForCourse');
    Route::post('un-enroll-course', 'Controller@unEnrollForCourse');
    Route::post('finish-rating-course', 'Controller@finishRatingCourse');
    Route::get('enable-all-rating', 'Controller@enableAllRating');
    Route::get('disable-all-rating', 'Controller@disableAllRating');
    Route::get('get-all-course', 'Controller@getAllCourses');
    Route::get('get-enrolled-course/{id}', 'Controller@getAllEnrolledCourses');
    Route::get('get-unenrolled-course/{id}', 'Controller@getAllUnEnrolledCourses');
    Route::get('get-teachers-assessment/{id}', 'Controller@getTeachersAssessment');
    Route::get('get-teachers-assessment-with-teacher-id/{id}', 'Controller@getTeachersAssessmentWithTeacherId');
});


Route::group([
    // 'middleware' => ['api','access_token'],
    'prefix' => 'telegram'
], function () {
    Route::get('create/agent/{email}/{token}', 'Controller@createAgent');
    Route::get('get/agent/clients/{email}/{token}', 'Controller@getClients');
    Route::get('get/top/news', 'Controller@topnewsBot');
    Route::get('all/plans', 'PlanController@allPlans');
    Route::get('get/payment/info/{type}', 'AddressController@getInfo');
    Route::get('mail/2tier-reminder-email/{email}/{fee}', 'Controller@sendViolationMail');
    Route::get('mail/identity-violation-mail/{email}/{fee}', 'Controller@sendViolationMail');
    Route::post('mail/test', 'Controller@testEmail');
    Route::post('register/mailer', 'Controller@registerMailer');
    Route::post('login/mailer', 'Controller@loginMailer');
    Route::post('credit/mailer/wallet', 'Controller@creditMailerWallet');
    Route::post('single/test', 'Controller@singleTest');
});
