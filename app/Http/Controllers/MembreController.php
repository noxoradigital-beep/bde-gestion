<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

// Page "Membres BDE" (réservée aux admins) : liste des membres + leurs rôles + invitations.
class MembreController extends Controller
{
    // Liste des membres BDE et des invitations envoyées.
    public function index(): View
    {
        $membres = User::orderBy('name')->get();
        $invitations = Invitation::with('createur', 'utilisateur')->latest()->get();

        return view('membres.index', compact('membres', 'invitations'));
    }

    // Change le rôle (admin/membre) d'un membre.
    public function update(Request $request, User $membre): RedirectResponse
    {
        $data = $request->validate([
            'role' => ['required', 'in:admin,membre'],
        ]);

        // Garde-fou : on ne peut pas se retirer le rôle admin si on est le dernier admin.
        if ($membre->id === $request->user()->id && $data['role'] === 'membre') {
            $autresAdmins = User::where('role', 'admin')->where('id', '!=', $membre->id)->exists();

            if (! $autresAdmins) {
                return back()->withErrors(['role' => 'Impossible de te retirer les droits admin : tu es le seul administrateur.']);
            }
        }

        $membre->update($data);

        return redirect()->route('membres.index')->with('status', 'Rôle mis à jour.');
    }

    // Supprime un membre BDE.
    public function destroy(Request $request, User $membre): RedirectResponse
    {
        if ($membre->id === $request->user()->id) {
            return back()->withErrors(['membre' => 'Impossible de te supprimer toi-même.']);
        }

        // Garde-fou : ne pas pouvoir supprimer le dernier administrateur.
        if ($membre->isAdmin()) {
            $autresAdmins = User::where('role', 'admin')->where('id', '!=', $membre->id)->exists();

            if (! $autresAdmins) {
                return back()->withErrors(['membre' => 'Impossible de supprimer le dernier administrateur.']);
            }
        }

        $membre->delete();

        return redirect()->route('membres.index')->with('status', 'Membre supprimé.');
    }
}
