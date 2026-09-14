<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ParticipationController extends Controller
{
    public function store(Request $request, Evenement $evenement): RedirectResponse
    {
        $data = $request->validate([
            'etudiant_id' => ['required', 'exists:etudiants,id'],
        ]);

        $evenement->etudiants()->syncWithoutDetaching([
            $data['etudiant_id'] => ['present' => false],
        ]);

        return redirect()->route('evenements.show', $evenement)->with('status', 'Participant ajouté.');
    }

    public function togglePresence(Evenement $evenement, int $etudiant): RedirectResponse
    {
        $participation = $evenement->etudiants()->where('etudiants.id', $etudiant)->first();

        if ($participation) {
            $evenement->etudiants()->updateExistingPivot($etudiant, [
                'present' => ! $participation->pivot->present,
            ]);
        }

        return redirect()->route('evenements.show', $evenement);
    }

    public function destroy(Evenement $evenement, int $etudiant): RedirectResponse
    {
        $evenement->etudiants()->detach($etudiant);

        return redirect()->route('evenements.show', $evenement)->with('status', 'Participant retiré.');
    }
}
