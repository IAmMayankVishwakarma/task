<?php

use App\Http\Controllers\WEB\WebDashboardController;
use App\Http\Controllers\WEB\WebDepartmentController;
use App\Http\Controllers\WEB\WebEmployeeController;
use App\Http\Controllers\WEB\WebRegisterController;
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
// Route::resource('web-employees', WebEmployeeController::class);
// Route::resource('web-departments', WebDepartmentController::class);
// Route::get('/dashboard', [WebDashboardController::class, 'index'])->name('dashboard');

// // Route::middleware('guest')->group(function () {
//     Route::get('login', [WebRegisterController::class, 'showLoginForm'])->name('login');
//     Route::post('login', [WebRegisterController::class, 'login']);
//     Route::get('register', [WebRegisterController::class, 'showRegisterForm'])->name('register');
//     Route::post('register', [WebRegisterController::class, 'register']);
// // });
// Auth Routes
Route::get('login', [WebRegisterController::class, 'showLoginForm'])->name('login');
Route::post('login', [WebRegisterController::class, 'login']);
Route::get('register', [WebRegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register', [WebRegisterController::class, 'register']);
Route::post('logout', [WebRegisterController::class, 'logout'])->name('logout');

// Dashboard Route (protected)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [WebDashboardController::class, 'index'])->name('dashboard');
    
    // Protected resources
    Route::resource('web-employees', WebEmployeeController::class);
    Route::resource('web-departments', WebDepartmentController::class);
});


