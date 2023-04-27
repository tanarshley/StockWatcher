<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockWatcherController;
use App\Http\Controllers\Auth\ForgotPasswordController;
//auth middleware
use App\Http\Middleware\AuthEmployeeCheck;
use App\Http\Middleware\AuthConstituentCheck;

//employee controllers
use App\Http\Controllers\Employee\EmployeeLoginController;
use App\Http\Controllers\Employee\EmployeeAccountInformationController;
use App\Http\Controllers\Employee\EmployeeEmployeesController;
use App\Http\Controllers\Employee\ConstituentsListController;
use App\Http\Controllers\Employee\EmployeeRequestHistoryController;
use App\Http\Controllers\Employee\AddEmployeeController;
use App\Http\Controllers\Employee\EmployeeLogoutController;
use App\Http\Controllers\Employee\EmployeeReleaseMedicineHistory;

//medicine controllers
use App\Http\Controllers\Medicine\DashboardController;
use App\Http\Controllers\Medicine\MedicinesController;
use App\Http\Controllers\Medicine\MedicineRequestsController;
use App\Http\Controllers\Medicine\ExpiredMedicinesController;

//constituent controllers
use App\Http\Controllers\Constituent\ConstituentLoginController;
use App\Http\Controllers\Constituent\ConstituentRequestsController;
use App\Http\Controllers\Constituent\ConstituentMedicineRequestController;
use App\Http\Controllers\Constituent\ConstituentAccountInformationController;
use App\Http\Controllers\Constituent\ConstituentLogoutController;

//pdf controllers
use App\Http\Controllers\PdfController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//set the default route to the stockwatcher
Route::get('/', function () {
    return redirect()->route('stockwatcher.home');
});

//pdf download
Route::get('/pdf/medicines', [PdfController::class, 'downloadMedicinesToPdf'])->name('pdf.medicines');
Route::get('/pdf/expired-medicines', [PdfController::class, 'downloadExpiredMedicinesToPdf'])->name('pdf.expired-medicines');
Route::get('/pdf/medicine-requests', [PdfController::class, 'downloadMedicineRequestsToPdf'])->name('pdf.medicine-requests');
Route::get('/pdf/constituents', [PdfController::class, 'downloadConstituentsToPdf'])->name('pdf.constituents');
Route::get('/pdf/employees', [PdfController::class, 'downloadEmployeesToPdf'])->name('pdf.employees');
Route::get('/pdf/request-history', [PdfController::class, 'downloadRequestHistoryToPdf'])->name('pdf.request-history');
Route::get('/pdf/release-history', [PdfController::class, 'downloadReleaseHistoryToPdf'])->name('pdf.release-history');

//employee forgot-password
Route::get('forget-password', [ForgotPasswordController::class, 'ForgetPassword'])->name('ForgetPasswordGet');
Route::post('forget-password', [ForgotPasswordController::class, 'ForgetPasswordStore'])->name('ForgetPasswordPost');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'ResetPassword'])->name('ResetPasswordGet');
Route::post('reset-password', [ForgotPasswordController::class, 'ResetPasswordStore'])->name('ResetPasswordPost');

//constituent forgot-password
Route::get('forget-password-constituent', [ForgotPasswordController::class, 'ForgetPasswordConstituent'])->name('ForgetPasswordConstituentGet');
Route::post('forget-password-constituent', [ForgotPasswordController::class, 'ForgetPasswordStoreConstituent'])->name('ForgetPasswordConstituentPost');
Route::get('reset-password-constituent/{token}', [ForgotPasswordController::class, 'ResetPasswordConstituent'])->name('ResetPasswordConstituentGet');
Route::post('reset-password-constituent', [ForgotPasswordController::class, 'ResetPasswordStoreConstituent'])->name('ResetPasswordConstituentPost');

//landing-page
Route::get('/stockwatcher/home', [StockWatcherController::class, 'showHome'])->name('stockwatcher.home');
Route::get('/stockwatcher/about-us', [StockWatcherController::class, 'showAboutUs'])->name('stockwatcher.about-us');
Route::get('/stockwatcher/contact-us', [StockWatcherController::class, 'showContactUs'])->name('stockwatcher.contact-us');

//employee
Route::post('/employee/employee-login', [EmployeeLoginController::class, 'loginEmployee'])->name('employee.employee-login');
Route::get('/employee/logout', [EmployeeLogoutController::class, 'logout'])->name('employee.logout');
Route::group(['middleware'=>['AuthEmployeeCheck']], function(){
    //get all the blades in resources/views/employee
    Route::get('/employee/login', [EmployeeLoginController::class, 'showLogin'])->name('employee.login');
    Route::get('/employee/dashboard', [DashboardController::class, 'showDashboard'])->name('employee.dashboard');
    Route::get('/employee/release-history', [EmployeeReleaseMedicineHistory::class, 'showReleaseMedicineHistory'])->name('employee.release-history');
    Route::post('/employee/release-medicine/{medicine_id}', [MedicinesController::class, 'releaseMedicine'])->name('employee.release-medicine');
    Route::get('/employee/medicines', [MedicinesController::class, 'showMedicines'])->name('employee.medicines');
    Route::post('/employee/add-medicine', [MedicinesController::class, 'addMedicine'])->name('employee.add-medicine');
    Route::put('/employee/edit-medicine/{medicine_id}', [MedicinesController::class, 'editMedicine'])->name('employee.edit-medicine');
    Route::delete('/employee/delete-medicine/{medicine_id}', [MedicinesController::class, 'deleteMedicine'])->name('employee.delete-medicine');
    Route::get('/employee/medicine-requests', [MedicineRequestsController::class, 'showMedicineRequests'])->name('employee.medicine-requests');
    Route::put('/employee/approve-medicine-request/{medicine_request_id}', [MedicineRequestsController::class, 'approveMedicineRequest'])->name('employee.approve-medicine-request');
    Route::put('/employee/reject-medicine-request/{medicine_request_id}', [MedicineRequestsController::class, 'rejectMedicineRequest'])->name('employee.reject-medicine-request');
    Route::put('/employee/delivered-medicine-request/{medicine_request_id}', [MedicineRequestsController::class, 'deliveredMedicineRequest'])->name('employee.delivered-medicine-request');
    Route::get('/employee/expired-medicines', [ExpiredMedicinesController::class, 'showExpiredMedicines'])->name('employee.expired-medicines');
    Route::delete('/employee/delete-expired-medicine/{expired_medicine_id}', [ExpiredMedicinesController::class, 'deleteExpiredMedicine'])->name('employee.delete-expired-medicine');
    Route::get('/employee/account-information', [EmployeeAccountInformationController::class, 'showAccountInformation'])->name('employee.account-information');
    Route::put('/employee/edit-account-information/{employee_id}', [EmployeeAccountInformationController::class, 'editAccountInformation'])->name('employee.edit-account-information');
    Route::put('/employee/edit-account-password/{employee_id}', [EmployeeAccountInformationController::class, 'editAccountPassword'])->name('employee.edit-account-password');
    Route::get('/employee/employees', [EmployeeEmployeesController::class, 'showEmployees'])->name('employee.employees');
    Route::post('/employee/add-employee', [AddEmployeeController::class, 'addEmployee'])->name('employee.add-employee');
    Route::get('/employee/constituents-list', [ConstituentsListController::class, 'showConstituentLists'])->name('employee.constituents-list');
    Route::post('/employee/add-constituent', [ConstituentsListController::class, 'addConstituent'])->name('employee.add-constituent');
    Route::delete('/employee/delete-constituent/{constituent_id}', [ConstituentsListController::class, 'deleteConstituent'])->name('employee.delete-constituent');
    Route::delete('/employee/delete-employee/{employee_id}', [EmployeeEmployeesController::class, 'deleteEmployee'])->name('employee.delete-employee');
    Route::get('/employee/requests-history', [EmployeeRequestHistoryController::class, 'showRequestHistory'])->name('employee.requests-history');
    Route::delete('/employee/delete-history/{request_history_id}', [EmployeeRequestHistoryController::class, 'deleteHistory'])->name('employee.delete-history');
    Route::get('/employee/medicines/search', [MedicinesController::class, 'searchMedicine'])->name('employee.medicines.search');    
});

//constituent
Route::post('/constituent/constituent-login', [ConstituentLoginController::class, 'loginConstituent'])->name('constituent.constituent-login');
Route::get('/constituent/logout', [ConstituentLogoutController::class, 'logout'])->name('constituent.logout');
Route::group(['middleware'=>['AuthConstituentCheck']], function(){
    //get all the blades in resources/views/constituent
    Route::get('/constituent/login', [ConstituentLoginController::class, 'showLogin'])->name('constituent.login');
    Route::get('/constituent/requests', [ConstituentRequestsController::class, 'showRequests'])->name('constituent.requests');
    Route::get('/constituent/request-medicine', [ConstituentMedicineRequestController::class, 'showRequestMedicine'])->name('constituent.request-medicine');
    Route::post('/constituent/request-medicine-post/{constituent_id}', [ConstituentMedicineRequestController::class, 'requestMedicine'])->name('constituent.request-medicine-post');
    Route::delete('/constituent/medicine-request-cancel/{medicine_id}', [ConstituentMedicineRequestController::class, 'cancelMedicineRequest'])->name('constituent.medicine-request-cancel');
    Route::get('/constituent/requests-history', [ConstituentMedicineRequestController::class, 'showRequestHistory'])->name('constituent.requests-history');
    Route::get('/constituent/account-information', [ConstituentAccountInformationController::class, 'showAccountInformation'])->name('constituent.account-information');
    Route::put('/constituent/edit-account-information/{constituent_id}', [ConstituentAccountInformationController::class, 'editAccountInformation'])->name('constituent.edit-account-information');
    Route::put('/constituent/edit-account-password/{constituent_id}', [ConstituentAccountInformationController::class, 'editAccountPassword'])->name('constituent.edit-account-password');
});
