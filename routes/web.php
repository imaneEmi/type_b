<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


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

Route::get('/', function () {
    return view('home');
})->name('home');

/*Route::get('/admin_edit_form', function () {
    return view('admin_edit_demande');
});*/

Route::get('/admin_edit_form', [App\Http\Controllers\Admin\AdminsController::class, 'getManifestation']);
Route::get('/manif-details', [App\Http\Controllers\Admin\AdminsController::class, 'getManifestationDetails']);
Route::post('/delete_demande', [App\Http\Controllers\Admin\AdminsController::class, 'delete']);

Route::get('/email/verify', function () {
    return view('auth/verify');
});

Auth::routes(['verify' => true]);

// ******User's routes********
Route::middleware(['verified'])->group(function () {
    Route::get('/dashboard-user', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard.user');
    Route::get('/dashboard-user/create-request', [App\Http\Controllers\User\DashboardController::class, 'createRequest'])->name('create.request.form');
    Route::post('/dashboard-user/create-request', [App\Http\Controllers\User\DashboardController::class, 'createRequest'])->name('create.request.store');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard-admin', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.admin');
//******Admin's routes********
/*Route::group(['middleware' => 'verified'], function () {
    Route::get('/dashboard-admin', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.admin');
    Route::get('/admin_edit_form', function () {
        return view('admin/edit_demande');
    });
});*/
