<?php

use App\Http\Controllers\Admin\Dashboard\DashboardController as DashboardDashboardController;
use App\Http\Controllers\RedirectControllers\DashboardController;
use App\Http\Modules\User\RolePermissions;
use App\Http\Modules\User\Roles;
use App\Http\Modules\User\UserControllerComponent;
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

        Route::get('/roles', Roles::class)->name('admin.roles');
        Route::get('/roles/{role}/permissions', RolePermissions::class)->name('admin.roles_permissions');

        Route::get('/users', UserControllerComponent::class)->name('admin.users');
    });
});
