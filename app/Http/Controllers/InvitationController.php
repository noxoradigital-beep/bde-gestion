<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

// Génère les liens d'invitation qui permettent à un nouveau membre BDE de s'inscrire.
class InvitationController extends Controller
{
    // Crée un nouveau lien d'invitation (valable 3 jours, usage unique).
    public function store(Request $request): RedirectResponse
    {
        Invitation::creerPour($request->user());

        return redirect()->route('membres.index')->with('status', "Lien d'invitation généré (valable 3 jours).");
    }
}
