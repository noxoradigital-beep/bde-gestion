<?php

use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\MembreController;
use App\Http\Controllers\ParticipationController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatistiqueController;
use App\Models\Etudiant;
use App\Models\Evenement;
use Illuminate\Support\Facades\Route;

// Page d'accueil : redirige direct vers le dashboard (si connecté) ou le login.
Route::get('/', function () {
    return redirect()->to(auth()->check() ? route('dashboard') : route('login'));
});

// Vue d'ensemble : chiffres cles + prochains evenements (mêmes donnees que Statistiques).
Route::get('/dashboard', function () {
    return view('dashboard', [
        'totalEtudiants' => Etudiant::count(),
        'totalEvenements' => Evenement::count(),
        'prochainsEvenements' => Evenement::withCount('etudiants')
            ->where('date', '>=', now())
            ->orderBy('date')
            ->limit(5)
            ->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// Défi 2FA présenté après un mot de passe valide, avant que la session ne soit ouverte.
Route::middleware('guest')->group(function () {
    Route::get('/two-factor-challenge', [TwoFactorController::class, 'challenge'])->name('two-factor.challenge');
    Route::post('/two-factor-challenge', [TwoFactorController::class, 'verify'])->name('two-factor.verify');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/two-factor', [TwoFactorController::class, 'setup'])->name('two-factor.setup');
    Route::post('/two-factor', [TwoFactorController::class, 'enable'])->name('two-factor.enable');
    Route::delete('/two-factor', [TwoFactorController::class, 'disable'])->name('two-factor.disable');

    // ----- Étudiants : CRUD (resource = index/create/store/show/edit/update/destroy d'un coup) + import/export -----
    Route::resource('etudiants', EtudiantController::class);
    Route::get('/etudiants-import', [ImportController::class, 'create'])->name('etudiants.import');
    Route::post('/etudiants-import', [ImportController::class, 'store'])->name('etudiants.import.store');
    Route::get('/etudiants-export', [ExportController::class, 'etudiants'])->name('etudiants.export');

    Route::get('/planning', [PlanningController::class, 'index'])->name('planning.index');

    // ----- Événements : CRUD + export + gestion des participants (inscription, présence, paiement) -----
    Route::resource('evenements', EvenementController::class);
    Route::get('/evenements-export', [ExportController::class, 'evenements'])->name('evenements.export');
    Route::get('/evenements/{evenement}/paiements-export', [ExportController::class, 'paiements'])->name('evenements.paiements.export');
    Route::post('/evenements/{evenement}/participants', [ParticipationController::class, 'store'])->name('participations.store');
    Route::patch('/evenements/{evenement}/participants/{etudiant}/presence', [ParticipationController::class, 'togglePresence'])->name('participations.presence');
    Route::patch('/evenements/{evenement}/participants/{etudiant}/paiement', [ParticipationController::class, 'togglePaiement'])->name('participations.paiement');
    Route::delete('/evenements/{evenement}/participants/{etudiant}', [ParticipationController::class, 'destroy'])->name('participations.destroy');

    Route::get('/statistiques', [StatistiqueController::class, 'index'])->name('statistiques.index');

    // ----- Réservé aux admins (middleware "admin" = EnsureUserIsAdmin) -----
    Route::middleware('admin')->group(function () {
        Route::get('/membres', [MembreController::class, 'index'])->name('membres.index');
        Route::patch('/membres/{membre}', [MembreController::class, 'update'])->name('membres.update');
        Route::delete('/membres/{membre}', [MembreController::class, 'destroy'])->name('membres.destroy');
        Route::post('/invitations', [InvitationController::class, 'store'])->name('invitations.store');
    });
});

require __DIR__.'/auth.php';
