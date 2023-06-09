<?php

use App\Http\Controllers\Admin\Dashboard\DashboardController as DashboardDashboardController;
use App\Http\Controllers\RedirectControllers\DashboardController;
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
})->name('welcome');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    //handle dashboard redirect for diffrent user
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    //Routes for Admin
    Route::prefix('/admin')->group(function () {

        Route::get('/dashboard', [DashboardDashboardController::class, 'index'])->name('admin.dashboard');

    });
});
