<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\StatisticsController;

use App\Imports\UserImport;

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

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('signin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/attendance-clock', [DashboardController::class, 'index_attendance'])->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/dashboard-admin', [DashboardController::class, 'index_admin'])->middleware('auth');

Route::get('/add-user', [DashboardController::class, 'index_tambah_user'])->middleware('auth');
Route::post('/user-input', [DashboardController::class, 'insert_data_user'])->middleware('auth');

Route::get('admin-detail/{id}', [DashboardController::class, 'index_edit'])->name('admin.edit')->middleware('auth');
Route::get('admin-delete/{id}', [DashboardController::class, 'delete_data'])->name('admin.delete')->middleware('auth');
Route::post('/user-update', [DashboardController::class, 'update_data'])->middleware('auth');

Route::post('clock_in', [AttendanceController::class, 'clock_in'])->middleware('auth');
Route::get('clock_out', [AttendanceController::class, 'clock_out'])->middleware('auth');

Route::get('statistics', [StatisticsController::class, 'index'])->middleware('auth');