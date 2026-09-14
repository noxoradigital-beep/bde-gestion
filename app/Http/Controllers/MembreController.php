<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MembreController extends Controller
{
    public function index(): View
    {
        $membres = User::orderBy('name')->get();
        $invitations = Invitation::with('createur', 'utilisateur')->latest()->get();

        return view('membres.index', compact('membres', 'invitations'));
    }

    public function update(Request $request, User $membre): RedirectResponse
    {
        $data = $request->validate([
            'role' => ['required', 'in:admin,membre'],
        ]);

        if ($membre->id === $request->user()->id && $data['role'] === 'membre') {
            $autresAdmins = User::where('role', 'admin')->where('id', '!=', $membre->id)->exists();

            if (! $autresAdmins) {
                return back()->withErrors(['role' => 'Impossible de te retirer les droits admin : tu es le seul administrateur.']);
            }
        }

        $membre->update($data);

        return redirect()->route('membres.index')->with('status', 'Rôle mis à jour.');
    }
}
