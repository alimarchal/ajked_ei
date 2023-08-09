<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ChallanController;
use App\Http\Controllers\ChallanTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\QuotaController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TestReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WiringContractorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return to_route('login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //
    Route::resource('roles',\App\Http\Controllers\RoleController::class);
    Route::resource('permissions',\App\Http\Controllers\PermissionController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::resource('challanType',ChallanTypeController::class);
    Route::resource('challan',ChallanController::class);

    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');

    Route::resource('quota',QuotaController::class);
    Route::resource('license',LicenseController::class);
    Route::resource('testReport',TestReportController::class);
    Route::get('testReport/{testReport}/review/create',[TestReportController::class,'review_create'])->name('testReport.review.create');
    Route::resource('review',ReviewController::class);
    Route::resource('wiringContractor',WiringContractorController::class);

});
