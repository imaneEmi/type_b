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

Route::get('/email/verify', function () {
    return view('auth/verify');
});

Auth::routes(['verify' => true]);

// ******User's routes********
Route::middleware(['verified'])->group(function () {

    //Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard-user', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard.user');
    Route::get('/dashboard-user/create-request', [App\Http\Controllers\User\DashboardController::class, 'createRequest'])->name('create.request.form');
    Route::post('/dashboard-user/create-request', [App\Http\Controllers\User\DashboardController::class, 'createRequest'])->name('create.request.store');
    Route::get('/dashboard-user/demande/{id}/pdf', [App\Http\Controllers\User\DashboardController::class, 'generatePDF'])->name('request.pdf');
    Route::post('/dashboard-user/manifestation/upload-rapport', [App\Http\Controllers\User\DashboardController::class, 'uploadRapport'])->name('manifestation.upload.rapport');
    Route::get('/dashboard-user/manifestation/rapport/{url}', [App\Http\Controllers\User\DashboardController::class, 'readRapport'])->name('manifestation.read.rapport');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// ********* Admin's routes *******
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard-admin', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.admin');
    Route::get('/traitement-dossier/{id}', [App\Http\Controllers\Admin\AdminsController::class, 'getManifestation'])
        ->name('admin.edit.manifestation');
    Route::get('/manif-details/{id}', [App\Http\Controllers\Admin\AdminsController::class, 'getManifestationDetails'])
        ->name('manifestation.details');
    Route::get('/demandes-courantes', [App\Http\Controllers\Admin\AdminsController::class, 'getDemandesCourantes'])
        ->name('demandes.courantes');
    Route::get('/demandes-acceptees', [App\Http\Controllers\Admin\AdminsController::class, 'getDemandesAcceptees'])
        ->name('demandes.acceptees');
    Route::get('/demandes-refusees', [App\Http\Controllers\Admin\AdminsController::class, 'getDemandesResfusees'])
        ->name('demandes.refusees');
    Route::get('/archive', [App\Http\Controllers\Admin\AdminsController::class, 'archive'])
        ->name('archive');
    Route::post('/accept-demande', [App\Http\Controllers\Admin\AdminsController::class, 'accept'])->name('accept.demande');
    Route::post('/delete-demande', [App\Http\Controllers\Admin\AdminsController::class, 'delete'])->name('delete.demande');
    Route::get('/edit-profile', [App\Http\Controllers\Admin\AdminsController::class, 'profile'])->name('edit.profile');
    Route::get('/edit-pieces', [App\Http\Controllers\Admin\AdminsController::class, 'pieceDemandee'])->name('edit.pieces');
    Route::get('/edit-frais', [App\Http\Controllers\Admin\AdminsController::class, 'fraisCouverts'])->name('edit.frais');
    Route::get('/edit-budgetFixe', [App\Http\Controllers\Admin\AdminsController::class, 'budgetFixe'])->name('edit.budgetFixe');
    Route::get('/traitement-dossier-pdf/{id}', [App\Http\Controllers\Admin\AdminsController::class, 'generatePdf'])->name('pdf');
    Route::post('/upload-lettre/{id}', [App\Http\Controllers\Admin\AdminsController::class, 'uploadLettre'])->name('upload.lettre');
    Route::get('manifastation/lettre/{url}', [App\Http\Controllers\Admin\AdminsController::class, 'getLettre'])->name('manifastation.lettre');
    Route::post('/save-admin', [App\Http\Controllers\Admin\AdminsController::class, 'saveAdmin'])->name('save-admin');
});
