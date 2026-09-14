<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Evenement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EvenementController extends Controller
{
    public function index(): View
    {
        $evenements = Evenement::withCount('etudiants')
            ->orderByDesc('date')
            ->paginate(20);

        return view('evenements.index', compact('evenements'));
    }

    public function create(): View
    {
        return view('evenements.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'lieu' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'capacite' => ['nullable', 'integer', 'min:1'],
        ]);

        $data['cree_par'] = $request->user()->id;

        $evenement = Evenement::create($data);

        return redirect()->route('evenements.show', $evenement)->with('status', 'Événement créé.');
    }

    public function show(Evenement $evenement): View
    {
        $evenement->load(['etudiants' => fn ($query) => $query->orderBy('nom')]);
        $etudiantsDisponibles = Etudiant::whereNotIn(
            'id',
            $evenement->etudiants->pluck('id')
        )->orderBy('nom')->get();

        return view('evenements.show', compact('evenement', 'etudiantsDisponibles'));
    }

    public function edit(Evenement $evenement): View
    {
        return view('evenements.edit', compact('evenement'));
    }

    public function update(Request $request, Evenement $evenement): RedirectResponse
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'lieu' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'capacite' => ['nullable', 'integer', 'min:1'],
        ]);

        $evenement->update($data);

        return redirect()->route('evenements.show', $evenement)->with('status', 'Événement modifié.');
    }

    public function destroy(Evenement $evenement): RedirectResponse
    {
        $evenement->delete();

        return redirect()->route('evenements.index')->with('status', 'Événement supprimé.');
    }
}
