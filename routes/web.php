<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\GraphController;
use App\Http\Controllers\Backend\ImportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// ----------------------------------------------------------------------
// Backend Routing
// ----------------------------------------------------------------------

Route::namespace('Auth')->group(function () {
    Route::get('/', [LoginController::class, 'login_show_page'])->name('login');
    Route::get('login', [LoginController::class, 'login_show_page'])->name('login');
    Route::post('login_processed', [LoginController::class, 'login_processed'])->name('login_processed');
    // Route::get('register', [LoginController::class, 'show_signup_form'])->name('register');
    // Route::post('register', [LoginController::class, 'process_signup']);
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('importcsv', [ImportController::class, 'index'])->name('importcsv');
    Route::post('import_processed', [ImportController::class, 'import_processed'])->name('import_processed');
    Route::get('graphic', [GraphController::class, 'index'])->name('graphic');
});
