<?php

use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\BesoinController;
use App\Http\Controllers\BilanController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\GenerationPdfActiviteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IntervenantController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PdfGenerateController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfilController;
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
  return view('Auth.login');
});

Auth::routes();

route::middleware('auth')->group(function () {

  Route::get('/home', [HomeController::class, 'index'])->name('home');

  Route::get('/redirection-new-user', function () {
    return view('composants.redirection-new-user');
  });

  Route::get('/acces-refuser', function () {
    return view('composants.acces_refuser');
  });

  // route pour la géneration de PDF de la liste des besoins
  // Route::get('/generate_pdf', [PdfGenerateController::class, 'generatepdf'])->name('generate_pdf');
  Route::get('/user-pdf', [UserController::class, 'generatepdf'])->name('users.pdf');
  Route::get('/generate-profil-pdf', [ProfilController::class, 'pdfProfil'])->name('profils.pdf');
  Route::get('/generate-projet-pdf', [ProjetController::class, 'pdfProjet'])->name('projets.pdf');
  Route::get('/generate-besoin-pdf', [BesoinController::class, 'pdfBesoin'])->name('besoins.pdf');
  Route::get('/generate-rapport-pdf', [RapportController::class, 'pdfRapport'])->name('rapports.pdf');
  Route::get('/generate-activite-pdf', [ActiviteController::class, 'pdfActivite'])->name('activites.pdf');
  Route::get('/generate-client-pdf', [ClientController::class, 'pdfClient'])->name('clients.pdf');
  Route::get('/generate-intervenant-pdf', [IntervenantController::class, 'pdfIntervenant'])->name('intervenants.pdf');

  // route pour la géneration le PDF d'un utilisateur spécifique
  Route::get('/profil-pdf', [ProfilController::class, 'profilpdf'])->name('profil.pdf');
  Route::get('/besoin-pdf', [BesoinController::class, 'besoinpdf'])->name('besoin.pdf');
  Route::get('/rapport-pdf', [RapportController::class, 'rapportpdf'])->name('rapport.pdf');
  Route::get('/client-pdf', [ClientController::class, 'clientpdf'])->name('client.pdf');
  Route::get('/intervenant-pdf', [IntervenantController::class, 'intervenantpdf'])->name('intervenant.pdf');
  Route::get('/projet-pdf', [ProjetController::class, 'projetpdf'])->name('projet.pdf');
  Route::get('/activite-pdf', [ActiviteController::class, 'activitepdf'])->name('activite.pdf');

  Route::get('/notification', [NotificationController::class, 'index'])->name('notifications');

  Route::get('/mon-profil', [UserProfilController::class, 'profil'])->name('mon_profile');
  Route::post('/mon-profile-update', [UserProfilController::class, 'updateProfile'])->name('mon_profile.update');

  Route::get('/password-change', [ChangePasswordController::class, 'index'])->name('password.change');
  Route::post('/password-changement', [ChangePasswordController::class, 'changePassword'])->name('password.changement');

  Route::prefix('users')->group(
    function () {
      Route::get('/', [UserController::class, 'index'])->name('users');
      Route::get('/create', [UserController::class, 'create'])->name('users.create');
      Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('users.edit');
      Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
    }
  );

  Route::prefix('profils')->group(
    function () {
      Route::get('/', [ProfilController::class, 'index'])->name('profils');
      Route::get('/create', [ProfilController::class, 'create'])->name('profils.create');
      Route::get('/edit-profil/{profil}', [ProfilController::class, 'edit'])->name('profils.edit');
      Route::get('/{profil}', [ProfilController::class, 'show'])->name('profils.show');
    }
  );

  Route::prefix('roles')->group(
    function () {
      Route::get('/', [RoleController::class, 'index'])->name('roles');
      Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
      Route::get('/edit/{role}', [RoleController::class, 'edit'])->name('roles.edit');
      Route::get('/{role}', [RoleController::class, 'show'])->name('roles.show');
    }
  );

  Route::prefix('projets')->group(
    function () {
      Route::get('/', [ProjetController::class, 'index'])->name('projets');
      Route::get('/create', [ProjetController::class, 'create'])->name('projets.create');
      Route::get('/edit-projet/{projet}', [ProjetController::class, 'edit'])->name('projets.edit');
      Route::get('/{projet}', [ProjetController::class, 'show'])->name('projets.show');
    }
  );

  Route::prefix('activites')->group(
    function () {
      Route::get('/', [ActiviteController::class, 'index'])->name('activites');
      Route::get('/create', [ActiviteController::class, 'create'])->name('activites.create');
      Route::get('/edit/{activite}', [ActiviteController::class, 'edit'])->name('activites.edit');
      Route::get('/{activite}', [ActiviteController::class, 'show'])->name('activites.show');
    }
  );

  Route::prefix('rapports')->group(
    function () {
      Route::get('/', [RapportController::class, 'index'])->name('rapports');
      Route::get('/create', [RapportController::class, 'create'])->name('rapports.create');
      Route::get('/edit-rapport/{rapport}', [RapportController::class, 'edit'])->name('rapports.edit');
      Route::get('/{rapport}', [RapportController::class, 'show'])->name('rapports.show');
    }
  );

  // routes besoins
  Route::prefix('besoins')->group(
    function () {
      Route::get('/', [BesoinController::class, 'index'])->name('besoins');
      Route::get('/create', [BesoinController::class, 'create'])->name('besoins.create');
      Route::get('/edit-besoin/{besoin}', [BesoinController::class, 'edit'])->name('besoins.edit');
      Route::get('/{besoin}', [BesoinController::class, 'show'])->name('besoins.show');
    }
  );

  Route::prefix('clients')->group(
    function () {
      Route::get('/', [ClientController::class, 'index'])->name('clients');
      Route::get('/create', [ClientController::class, 'create'])->name('clients.create');
      Route::get('/edit-client/{client}', [ClientController::class, 'edit'])->name('clients.edit');
      Route::get('/{client}', [ClientController::class, 'show'])->name('clients.show');
    }
  );

  Route::prefix('intervenants')->group(
    function () {
      Route::get('/', [IntervenantController::class, 'index'])->name('intervenants');
      Route::get('/create', [IntervenantController::class, 'create'])->name('intervenants.create');
      Route::get('/edit-intervenant/{intervenant}', [IntervenantController::class, 'edit'])->name('intervenants.edit');
      Route::get('/{intervenant}', [IntervenantController::class, 'show'])->name('intervenants.show');
    }
  );

  Route::prefix('notifications')->group(
    function () {
      Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    }
  );


  Route::prefix('bilans')->group(
    function () {
      Route::get('/bilan', [BilanController::class, 'index'])->name('bilans');
      Route::get('/create', [BilanController::class, 'create'])->name('bilans.create');
      Route::get('/bilan-journalier', [BilanController::class, 'generateBilan'])->name('bilans.pdf');
      Route::get('/bilan-periode', [BilanController::class, 'generatePeriodeBilan'])->name('bilans.periode');
    }
  );
  Route::get('/bilan-activite', [GenerationPdfActiviteController::class, 'generateActivitepdfBilan'])->name('bilans.activite');

});