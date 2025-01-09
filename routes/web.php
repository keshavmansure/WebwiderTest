<?php

use App\Http\Controllers\Admin\BranchHistoryController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\Users\LoginController;
use App\Http\Middleware\ValidateAuthMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth:web')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('users.logout');
    Route::resource('branches', BranchController::class);
});
Route::middleware('auth:admin')->group(function () {
    Route::post('admin/logout', [AdminLoginController::class, 'logout'])->name('admins.logout');

    Route::get('branch-histories', BranchHistoryController::class)->name('branch-histories.index');
});


Route::middleware('guest')->group(function () {
    Route::get('users/login', [LoginController::class, 'index'])->name('users.index');
    Route::get('admins/login', [AdminLoginController::class, 'index'])->name('admins.index');
});



Route::post('admins/login', [AdminLoginController::class, 'login'])->name('admins.login');
Route::post('users/login', [LoginController::class, 'login'])->name('users.login');
