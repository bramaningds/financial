<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportExpenseController;
use App\Http\Controllers\ReportSummaryController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ReportStatementController;
use App\Http\Controllers\Repositories\UserController;
use App\Http\Controllers\Repositories\AccountController;
use App\Http\Controllers\Repositories\ActivityController;
use App\Http\Controllers\Repositories\CategoryController;
use App\Http\Controllers\Repositories\TransferController;

Route::get('/phpinfo', fn () => phpinfo());

Route::get('/', HomeController::class);

Route::middleware('auth')->group(function () {
    Route::resource('/account', AccountController::class);
    Route::resource('/activity', ActivityController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/transfer', TransferController::class);
    Route::resource('/user', UserController::class);
    Route::get('/report/statement', ReportStatementController::class);
    Route::get('/report/summary', ReportSummaryController::class);
});

Route::controller(AuthenticationController::class)->group(function () {
    Route::get('/login', 'getLogin');
    Route::post('/login', 'postLogin');

    Route::get('/logout', 'getLogout');

    Route::get('/register', 'getRegister');
    Route::post('/register', 'postRegister');
});
