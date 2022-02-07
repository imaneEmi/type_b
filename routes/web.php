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
    Route::post('/dashboard-user/manifestation/add-file', [App\Http\Controllers\User\DashboardController::class, 'addFile'])->name('manifestation.add.file');
    Route::get('/dashboard-user/manifestation/rapport/{url}', [App\Http\Controllers\User\DashboardController::class, 'readRapport'])->name('manifestation.read.rapport');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// ********* Admin's routes *******

//Admin should be authenticated to access these routes
Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/edit-profile', [App\Http\Controllers\Admin\AdminsController::class, 'profile'])->name('edit.profile');
    Route::get('/edit-pieces', [App\Http\Controllers\Admin\AdminsController::class, 'pieceDemandee'])->name('edit.pieces');
    Route::get('/edit-frais', [App\Http\Controllers\Admin\AdminsController::class, 'fraisCouverts'])->name('edit.frais');
    Route::post('/edit-budgetFixe', [App\Http\Controllers\Admin\EditBudgetController::class, 'save'])->name('save.budgetFixe');
    Route::get('/edit-budgetFixe', [App\Http\Controllers\Admin\EditBudgetController::class, 'edit'])->name('edit.budgetFixe');
    Route::get('/archive', [App\Http\Controllers\Admin\AdminsController::class, 'archive'])
        ->name('archive');
});


//Admin should be authenticated and the current annual budget should be set to access these routes
Route::group(['middleware' => ['budgetFixeSet', 'admin']], function () {
    Route::get('/dashboard-admin', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.admin');
    Route::get('/traitement-dossier/{id}', [App\Http\Controllers\Admin\AdminsController::class, 'getManifestation']);
    Route::get('/statistiques-admin', [App\Http\Controllers\Admin\StatistiquesController::class, 'index'])->name('statistiques.admin');
    Route::post('/rechercher', [App\Http\Controllers\Admin\StatistiquesController::class, 'search'])->name('statistiques.search');
    Route::get('/admin_edit_form/{id}', [App\Http\Controllers\Admin\AdminsController::class, 'getManifestation'])
        ->name('admin.edit.manifestation');
    Route::get('/manif-details/{id}', [App\Http\Controllers\Admin\AdminsController::class, 'getManifestationDetails'])
        ->name('manifestation.details');
    Route::get('/demandes-enCours', [App\Http\Controllers\Admin\AdminsController::class, 'getDemandesEnCours'])
        ->name('demandes.enCours');
    Route::get('/demandes-courantes', [App\Http\Controllers\Admin\AdminsController::class, 'getDemandesCourantes'])
        ->name('demandes.courantes');
    Route::get('/demandes-acceptees', [App\Http\Controllers\Admin\AdminsController::class, 'getDemandesAcceptees'])
        ->name('demandes.acceptees');
    Route::get('/demandes-refusees', [App\Http\Controllers\Admin\AdminsController::class, 'getDemandesResfusees'])
        ->name('demandes.refusees');
    Route::get('/archive', [App\Http\Controllers\Admin\AdminsController::class, 'archive'])
        ->name('archive');
    Route::post('/edit-montant', [App\Http\Controllers\Admin\AdminsController::class, 'editMontant'])->name('edit.montant');
    Route::get('/accept-demande/{id}', [App\Http\Controllers\Admin\AdminsController::class, 'accept'])->name('accept.demande');
    Route::get('/reject-demande/{id}', [App\Http\Controllers\Admin\AdminsController::class, 'reject'])->name('reject.demande');
    Route::get('/delete-demande/{id}', [App\Http\Controllers\Admin\AdminsController::class, 'delete'])->name('delete.demande');
    Route::get('/edit-profile', [App\Http\Controllers\Admin\AdminsController::class, 'profile'])->name('edit.profile');
    Route::get('/edit-pieces', [App\Http\Controllers\Admin\AdminsController::class, 'pieceDemandee'])->name('edit.pieces');
    Route::get('/edit-frais', [App\Http\Controllers\Admin\AdminsController::class, 'fraisCouverts'])->name('edit.frais');
    Route::get('/edit-budgetFixe', [App\Http\Controllers\Admin\AdminsController::class, 'budgetFixe'])->name('edit.budgetFixe');
    Route::get('/traitement-dossier-pdf/{id}', [App\Http\Controllers\Admin\AdminsController::class, 'generatePdf'])->name('pdf');
    Route::post('/upload-lettre/{id}', [App\Http\Controllers\Admin\AdminsController::class, 'uploadLettre'])->name('upload.lettre');
    Route::get('manifastation/lettre/{url}', [App\Http\Controllers\Admin\AdminsController::class, 'getLettre'])->name('manifastation.lettre');
    Route::post('/admin/profile', [App\Http\Controllers\Admin\AdminsController::class, 'profile'])->name('profile.admin');
    Route::post('/edit-budgetFixe', [App\Http\Controllers\Admin\EditBudgetController::class, 'save'])->name('save.budgetFixe');
    Route::get('/edit-budgetFixe', [App\Http\Controllers\Admin\EditBudgetController::class, 'edit'])->name('edit.budgetFixe');
    Route::post('/notification-email', [App\Http\Controllers\Admin\AdminsController::class, 'notificationEmail'])->name('emails.notify');
    Route::post('/custom-email', [App\Http\Controllers\Admin\AdminsController::class, 'customEmail'])->name('emails.custom');
    Route::get('/disable-upload/{id}', [App\Http\Controllers\Admin\AdminsController::class, 'disableUpload'])->name('disableUpload');
    Route::post('/demande-estimationDotation/{id}', [App\Http\Controllers\Admin\AdminsController::class, 'estimationDotation'])->name('demande.estimationDotation');

    Route::post('/create-piece', [App\Http\Controllers\Admin\PieceDemandeController::class, 'create'])->name('piece_demandee.create');
    Route::post('/update-piece', [App\Http\Controllers\Admin\PieceDemandeController::class, 'update'])->name('piece_demandee.update');
    Route::get('/delete-piece/{id}', [App\Http\Controllers\Admin\PieceDemandeController::class, 'delete'])->name('piece_demandee.delete');
    Route::get('/pieces', [App\Http\Controllers\Admin\PieceDemandeController::class, 'index'])->name('piece_demandee.list');

    Route::post('/frais_couvert', [App\Http\Controllers\Admin\FraisCouvetController::class, 'create'])->name('frais_couvert.create');
    Route::post('/update-frais_couvert', [App\Http\Controllers\Admin\FraisCouvetController::class, 'update'])->name('frais_couvert.update');
    Route::get('/delete-frais_couvert/{id}', [App\Http\Controllers\Admin\FraisCouvetController::class, 'delete'])->name('frais_couvert.delete');
    Route::get('/frais_couvert', [App\Http\Controllers\Admin\FraisCouvetController::class, 'index'])->name('frais_couvert.list');

    Route::post('/type_contributeur', [App\Http\Controllers\Admin\TypeContributeurController::class, 'create'])->name('type_contributeur.create');
    Route::post('/update-type_contributeur', [App\Http\Controllers\Admin\TypeContributeurController::class, 'update'])->name('type_contributeur.update');
    Route::get('/delete-type_contributeur/{id}', [App\Http\Controllers\Admin\TypeContributeurController::class, 'delete'])->name('type_contributeur.delete');
    Route::get('/type_contributeur', [App\Http\Controllers\Admin\TypeContributeurController::class, 'index'])->name('type_contributeur.list');

    Route::post('/nature_contribution', [App\Http\Controllers\Admin\NatureContributionController::class, 'create'])->name('nature_contribution.create');
    Route::post('/update-nature_contribution', [App\Http\Controllers\Admin\NatureContributionController::class, 'update'])->name('nature_contribution.update');
    Route::get('/delete-nature_contribution/{id}', [App\Http\Controllers\Admin\NatureContributionController::class, 'delete'])->name('nature_contribution.delete');
    Route::get('/nature_contribution', [App\Http\Controllers\Admin\NatureContributionController::class, 'index'])->name('nature_contribution.list');

    Route::post('/conditions_generale', [App\Http\Controllers\Admin\ConditionsGeneraleController::class, 'create'])->name('conditions_generale.create');
    Route::post('/update-conditions_generale', [App\Http\Controllers\Admin\ConditionsGeneraleController::class, 'update'])->name('conditions_generale.update');
    Route::get('/delete-conditions_generale/{id}', [App\Http\Controllers\Admin\ConditionsGeneraleController::class, 'delete'])->name('conditions_generale.delete');
    Route::get('/conditions_generale', [App\Http\Controllers\Admin\ConditionsGeneraleController::class, 'index'])->name('conditions_generale.list');
});
