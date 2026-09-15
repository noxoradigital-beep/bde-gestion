<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

// CRUD étudiants (créer, lire, modifier, supprimer) + recherche et pagination.
class EtudiantController extends Controller
{
    // Liste des étudiants, avec recherche (nom/prénom/email/classe) et 20 par page.
    public function index(Request $request): View
    {
        $etudiants = Etudiant::query()
            // Si une recherche est tapée, filtre sur plusieurs colonnes à la fois.
            ->when($request->string('recherche')->toString(), function ($query, $recherche) {
                $query->where(function ($q) use ($recherche) {
                    $q->where('nom', 'like', "%{$recherche}%")
                        ->orWhere('prenom', 'like', "%{$recherche}%")
                        ->orWhere('email', 'like', "%{$recherche}%")
                        ->orWhere('classe', 'like', "%{$recherche}%");
                });
            })
            ->orderBy('nom')
            ->paginate(20)
            ->withQueryString();

        return view('etudiants.index', compact('etudiants'));
    }

    // Formulaire d'ajout d'un étudiant.
    public function create(): View
    {
        return view('etudiants.create');
    }

    // Enregistre le nouvel étudiant après validation du formulaire.
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:etudiants,email'],
            'classe' => ['required', 'string', 'max:255'],
            'option' => ['nullable', 'string', 'max:255'],
        ]);

        Etudiant::create($data);

        return redirect()->route('etudiants.index')->with('status', 'Étudiant ajouté.');
    }

    // Fiche d'un étudiant + la liste de ses événements (les plus récents en premier).
    public function show(Etudiant $etudiant): View
    {
        $etudiant->load(['evenements' => fn ($query) => $query->orderByDesc('date')]);

        return view('etudiants.show', compact('etudiant'));
    }

    // Formulaire de modification d'un étudiant.
    public function edit(Etudiant $etudiant): View
    {
        return view('etudiants.edit', compact('etudiant'));
    }

    // Enregistre les modifications de l'étudiant.
    public function update(Request $request, Etudiant $etudiant): RedirectResponse
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:etudiants,email,'.$etudiant->id],
            'classe' => ['required', 'string', 'max:255'],
            'option' => ['nullable', 'string', 'max:255'],
        ]);

        $etudiant->update($data);

        return redirect()->route('etudiants.index')->with('status', 'Étudiant modifié.');
    }

    // Supprime l'étudiant.
    public function destroy(Etudiant $etudiant): RedirectResponse
    {
        $etudiant->delete();

        return redirect()->route('etudiants.index')->with('status', 'Étudiant supprimé.');
    }
}
