<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        Invitation::creerPour($request->user());

        return redirect()->route('membres.index')->with('status', "Lien d'invitation généré (valable 3 jours).");
    }
}
