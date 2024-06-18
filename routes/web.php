<?php

use App\Http\Controllers\AdminController;
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

// Admin routes
Route::middleware('admin')->group(function () {
    Route::resource('employees', EmployeeController::class);
    Route::resource('bosses', BossController::class);
    Route::resource('stakeholders', StakeholderController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('clearanceForms', ClearanceFormController::class);
    Route::resource('cleanapp_update', cleanappController::class);
    Route::resource('clearanceFormApprovals', ClearanceFormApprovalController::class);
    Route::resource('employeeLocations', EmployeeLocationController::class);
    Route::resource('stakeholderLocations', StakeholderLocationController::class);
    Route::resource('admin', AdminController::class);
});

// Employee routes
Route::middleware('emp')->group(function () {
    Route::resource('emp', empController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
    Route::get('/clearance', [empController::class, 'clearance']);
});

// Boss routes
Route::middleware('boss')->group(function () {
    Route::resource('boss', bossmanController::class);
});

// Stakeholder routes
Route::middleware('stake')->group(function () {
    Route::resource('stake', stakeController::class);
    Route::resource('clean_update', CleanUpdateController::class);
   
});
Route::resource('employees', EmployeeController::class)->only(['index', 'show']);
// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout']);
