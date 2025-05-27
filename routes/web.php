<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware(['auth', 'role:1,2,3'])->group(function () {

    Route::get('dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('store-user', [UserController::class, 'storeUser'])->name('admin.storeUser');
    Route::get('delete-user/{id}', [UserController::class, 'deleteUser'])->name('admin.deleteUser');

});