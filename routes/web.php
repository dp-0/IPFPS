<?php
use App\Http\Controllers\Admin\Dashboard\DashboardController as DashboardDashboardController;
use App\Http\Controllers\FileDownloadController;
use App\Http\Controllers\ImageSearchResultController;
use App\Http\Controllers\RedirectControllers\DashboardController;
use App\Http\Controllers\RedirectControllers\ImageDetailsController;
use App\Http\Controllers\Search\ImageSearchController;
use App\Http\Controllers\TestController;
use App\Http\Modules\Fir\AddEvidenceComponent;
use App\Http\Modules\Fir\ComplainComponent;
use App\Http\Modules\Fir\NewComplainComponent;
use App\Http\Modules\Fir\SuspectProfileComponent;
use App\Http\Modules\User\RolePermissions;
use App\Http\Modules\User\Roles;
use App\Http\Modules\User\UserControllerComponent;
use Dp0\UserActivity\Controllers\UserActivity;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\Police\PoiceDashboardController;
use App\Http\Modules\Fir\ComplinantDetails;
use App\Http\Modules\Search\ImageSearch;
use App\Http\Modules\Search\ImageSearchDetails;

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

    //download file
    Route::get('/download/{hash}/{id}',[FileDownloadController::class,'download'])->name('download');
    //handle image search
    Route::get('/search/image', ImageSearch::class)->name('search.imagesearch');
    
    Route::get('/search/image/details',ImageDetailsController::class)->name('search.image.detail');
    //Routes for Admin
    Route::prefix('/admin')->group(function () {
        Route::get('/dashboard', [DashboardDashboardController::class, 'index'])->name('admin.dashboard');
        //User Management
        Route::get('/roles', Roles::class)->name('admin.roles');
        Route::get('/roles/{role}/permissions', RolePermissions::class)->name('admin.roles_permissions');
        Route::get('/users', UserControllerComponent::class)->name('admin.users');
        //Activity Log
        Route::get('/activity-logs', UserActivity::class)->name('admin.user_activity');

        //Fir Management

        Route::get('/complainants',\App\Http\Modules\Fir\ComplainantComponent::class)->name('admin.fir.complainants');
        Route::get('/complinants/details/{complinant}', ComplinantDetails::class)->name('admin.fir.complinants.details');
        Route::get('/incident-type',\App\Http\Modules\Fir\IncidentTypeComponent::class)->name('admin.fir.incident-type');
        Route::get('/case-priority',\App\Http\Modules\Fir\CasePriorityComponent::class)->name('admin.fir.case-priority');
        Route::get('/complain', ComplainComponent::class)->name('admin.fir.complain');
        Route::get('/complain/new', NewComplainComponent::class)->name('admin.fir.complain.new');
        Route::get('/complain/view/{complain}', \App\Http\Modules\Fir\ViewComplain::class)->name('admin.fir.complain.view');
        Route::get('/fir-status',\App\Http\Modules\Fir\FirStatusComponent::class)->name('admin.fir.fir-status');
        Route::get('/fir-list',\App\Http\Modules\Fir\FirListComponent::class)->name('admin.fir.fir-list');
        Route::get('/fir/new',\App\Http\Modules\Fir\NewFirComponent::class)->name('admin.fir.new');
        Route::get('/fir/view/{fir}',\App\Http\Modules\Fir\ViewFirComponent::class)->name('admin.fir.view');
        Route::get('/suspect/{suspect}/profile', SuspectProfileComponent::class)->name('admin.fir.suspect.profile');
        Route::get('/fir/{fir}/evidence/new', AddEvidenceComponent::class)->name('admin.fir.evidence.add');



    });

     //Routes for Admin
     Route::prefix('/police')->group(function () {

        Route::get('/dashboard', [PoiceDashboardController::class, 'index'])->name('police.dashboard');
       
    });
});
