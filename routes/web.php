<?php
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BossController;
use App\Http\Controllers\bossmanController;
use App\Http\Controllers\Clean_update;
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
use App\Http\Middleware\EnsureUserIsAuthenticated;

//admin controllers
Route::resource('employees', EmployeeController::class);
Route::resource('bosses', BossController::class);
Route::resource('stakeholders', StakeholderController::class);
Route::resource('locations', LocationController::class);
Route::resource('clearanceForms', ClearanceFormController::class);
Route::resource('clean_update', CleanUpdateController::class);
Route::resource('cleanapp_update', cleanappController::class);
Route::resource('clearanceFormApprovals', ClearanceFormApprovalController::class);
Route::resource('employeeLocations', EmployeeLocationController::class);
Route::resource('stakeholderLocations', StakeholderLocationController::class);
//employee controller

Route::get('/clearance', [empController::class, 'clearance']);

Route::resource('boss', bossmanController::class);
Route::resource('stake', stakeController::class);
Route::get('/login', [LoginController::class,'showLoginForm']);
Route::post('/login', [LoginController::class,'login'])->name('login');
Route::get('/logout', [LoginController::class,'logout']);
Route::resource('emp', empController::class)->middleware('check'); 

