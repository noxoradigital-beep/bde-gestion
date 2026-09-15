<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Evenement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

// CRUD événements (créer, lire, modifier, supprimer) + gestion payant/gratuit.
class EvenementController extends Controller
{
    // Liste des événements avec le nombre d'étudiants inscrits.
    public function index(): View
    {
        $evenements = Evenement::withCount('etudiants')
            ->withCount(['etudiants as payes_count' => fn ($query) => $query->where('participations.paye', true)])
            ->orderByDesc('date')
            ->paginate(20);

        return view('evenements.index', compact('evenements'));
    }

    // Formulaire de création d'un événement.
    public function create(): View
    {
        return view('evenements.create');
    }

    // Enregistre le nouvel événement. Si "payant" n'est pas coché, le prix est ignoré (mis à null).
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'lieu' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'capacite' => ['nullable', 'integer', 'min:1'],
            'payant' => ['nullable', 'boolean'],
            'prix' => ['nullable', 'required_if:payant,1', 'numeric', 'min:0'],
        ]);

        $data['payant'] = $request->boolean('payant');
        $data['prix'] = $data['payant'] ? $data['prix'] : null;

        $data['cree_par'] = $request->user()->id;

        $evenement = Evenement::create($data);

        return redirect()->route('evenements.show', $evenement)->with('status', 'Événement créé.');
    }

    // Fiche d'un événement : ses inscrits, + la liste des étudiants qu'on peut encore ajouter.
    public function show(Evenement $evenement): View
    {
        $evenement->load(['etudiants' => fn ($query) => $query->orderBy('nom')]);
        $etudiantsDisponibles = Etudiant::whereNotIn(
            'id',
            $evenement->etudiants->pluck('id')
        )->orderBy('nom')->get();

        return view('evenements.show', compact('evenement', 'etudiantsDisponibles'));
    }

    // Formulaire de modification d'un événement.
    public function edit(Evenement $evenement): View
    {
        return view('evenements.edit', compact('evenement'));
    }

    // Enregistre les modifications de l'événement (même logique payant/prix que store).
    public function update(Request $request, Evenement $evenement): RedirectResponse
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'lieu' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'capacite' => ['nullable', 'integer', 'min:1'],
            'payant' => ['nullable', 'boolean'],
            'prix' => ['nullable', 'required_if:payant,1', 'numeric', 'min:0'],
        ]);

        $data['payant'] = $request->boolean('payant');
        $data['prix'] = $data['payant'] ? $data['prix'] : null;

        $evenement->update($data);

        return redirect()->route('evenements.show', $evenement)->with('status', 'Événement modifié.');
    }

    // Supprime l'événement.
    public function destroy(Evenement $evenement): RedirectResponse
    {
        $evenement->delete();

        return redirect()->route('evenements.index')->with('status', 'Événement supprimé.');
    }
}
