<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

// Gère les inscriptions des étudiants à un événement (ajout, présence, paiement, retrait).
class ParticipationController extends Controller
{
    // Inscrit un étudiant à l'événement (présent=non et payé=non par défaut).
    public function store(Request $request, Evenement $evenement): RedirectResponse
    {
        $data = $request->validate([
            'etudiant_id' => ['required', 'exists:etudiants,id'],
        ]);

        $evenement->etudiants()->syncWithoutDetaching([
            $data['etudiant_id'] => ['present' => false, 'paye' => false],
        ]);

        return redirect()->route('evenements.show', $evenement)->with('status', 'Participant ajouté.');
    }

    // Bascule "présent / pas présent" pour un étudiant inscrit.
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

    // Bascule "a payé / n'a pas payé" pour un étudiant inscrit.
    public function togglePaiement(Evenement $evenement, int $etudiant): RedirectResponse
    {
        $participation = $evenement->etudiants()->where('etudiants.id', $etudiant)->first();

        if ($participation) {
            $evenement->etudiants()->updateExistingPivot($etudiant, [
                'paye' => ! $participation->pivot->paye,
            ]);
        }

        return redirect()->route('evenements.show', $evenement);
    }

    // Retire un étudiant de l'événement.
    public function destroy(Evenement $evenement, int $etudiant): RedirectResponse
    {
        $evenement->etudiants()->detach($etudiant);

        return redirect()->route('evenements.show', $evenement)->with('status', 'Participant retiré.');
    }
}
