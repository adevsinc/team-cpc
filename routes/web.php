<?php

use App\Http\Controllers\Frontend\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;

Route::get('/', function () {
    return redirect()->route('access.login');
});



// Auth Routes

Route::controller(AuthController::class)->group(function () {
    Route::get('/access/login', 'access_login')->name('access.login');
    Route::post('/otp', 'requestOtp')->name('request.otp');
    Route::post('/email-otp', 'requestEmailOtp')->name('request.email.otp');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('employee.logout');
});


Route::middleware(['web', \App\Http\Middleware\AdminAuth::class])->controller(DashboardController::class)->group(function () {
    Route::get('/app/social', 'dashboard')->name('app.social');
});

// Temporary sidebar demo routes
Route::get('/social', function() { return 'News Feed'; })->name('social');
Route::get('/scheduler', function() { return 'Shifts'; })->name('scheduler');
Route::get('/openshifts', function() { return 'Open Shifts'; })->name('openshifts');
Route::get('/timeoff', function() { return 'Paid Time Off'; })->name('timeoff');
Route::get('/schedulerrequests', function() { return 'Manage My Requests'; })->name('schedulerrequests');
Route::get('/todo-list', function() { return 'To-Do Lists'; })->name('todo.list');
Route::get('/performance', function() { return 'Performance Reviews'; })->name('performance');
Route::get('/course', function() { return 'Crust Pizza University'; })->name('course');
Route::get('/mitcourse', function() { return 'Manager Training Program'; })->name('mitcourse');
Route::get('/employee-directory', function() { return 'Employee Directory'; })->name('employee-directory');
Route::get('/document', function() { return 'My Files'; })->name('document');
Route::get('/accountsetting', function() { return 'My Profile'; })->name('accountsetting');
Route::get('/helpdesk/ticketlist', function() { return 'Help Center'; })->name('helpdesk.ticketlist');

