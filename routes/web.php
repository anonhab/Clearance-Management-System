<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\admindash;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BossController;
use App\Http\Controllers\bossmanController;
use App\Http\Controllers\cleanappController;
use App\Http\Controllers\CleanUpdateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StakeholderController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ClearanceFormController;
use App\Http\Controllers\ClearanceFormApprovalController;
use App\Http\Controllers\EmployeeLocationController;
use App\Http\Controllers\StakeholderLocationController;
use App\Http\Controllers\empController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\stakeController;
use App\Http\Controllers\SubstakeApprovalController;
use App\Http\Controllers\SubstakeController;
use App\Http\Controllers\SubController;

// Admin routes
Route::middleware('admin')->group(function () {
    Route::resource('employees', EmployeeController::class);
    Route::resource('bosses', BossController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('stakeholders', StakeholderController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('employeeLocations', EmployeeLocationController::class);
    Route::resource('stakeholderLocations', StakeholderLocationController::class);
    Route::resource('admin', AdminController::class);
    Route::resource('dashboard', admindash::class);
});

// Employee routes
Route::middleware('emp')->group(function () {
    Route::resource('emp', empController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
    Route::get('/clearance', [empController::class, 'clearance']);
    Route::get('/print', [empController::class, 'print']);
    Route::get('/profile', [empController::class, 'profile']);
    Route::get('/hasrequest', [empController::class, 'hasrequest']);
    Route::post('change-password', [empController::class, 'changePassword'])->name('changepassword');
    Route::get('/employee/image', [empController::class, 'showImage'])->name('employee.image');
    Route::get('/clearance-info', [EmployeeController::class, 'showinfo']);
});

// Boss routes
Route::middleware('boss')->group(function () {
    Route::resource('boss', bossmanController::class);
    Route::get('/bossprofile', [bossmanController::class, 'profile']);
    Route::post('boss_change-password', [bossmanController::class, 'changePassword'])->name('bosschangepassword');
    Route::get('/boss/image', [bossmanController::class, 'bossshowImage'])->name('boss.image');
});

// Stakeholder routes
Route::middleware('stake')->group(function () {
    Route::resource('stake', stakeController::class);
    Route::get('/stakeprofile', [stakeController::class, 'profile']);
    Route::post('stake_change-password', [stakeController::class, 'changePassword'])->name('stakechangepassword');
    Route::get('/stake/image', [stakeController::class, 'stakeshowImage'])->name('stake.image');
});
Route::get('/approverequest', [stakeController::class, 'approveRequest']);
Route::get('/set-employee-id-in-session/{employeeId}', [stakeController::class, 'setEmployeeIdInSession'])->name('set-employee-id-in-session');
Route::resource('employees', EmployeeController::class)->only(['index', 'show']);
Route::resource('clean_update', CleanUpdateController::class);
Route::resource('clearanceFormApprovals', ClearanceFormApprovalController::class);
Route::resource('clearanceForms', ClearanceFormController::class);
Route::resource('cleanapp_update', cleanappController::class);
// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::get('/', [LoginController::class, 'homepage']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout']);

Route::post('sub_change-password', [SubController::class, 'changePassword'])->name('subchangepassword');
// Resource routes for Substake
Route::resource('substakes', SubstakeController::class);
Route::resource('subs', SubController::class);
Route::get('/subprofile', [SubController::class, 'profile']);

Route::get('/sub/image', [SubstakeController::class, 'showImage'])->name('sub.image');

// Resource routes for SubstakeApproval
Route::resource('substakeapprovals', SubstakeApprovalController::class);