<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EtudiantController extends Controller
{
    public function index(Request $request): View
    {
        $etudiants = Etudiant::query()
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

    public function create(): View
    {
        return view('etudiants.create');
    }

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

    public function show(Etudiant $etudiant): View
    {
        $etudiant->load(['evenements' => fn ($query) => $query->orderByDesc('date')]);

        return view('etudiants.show', compact('etudiant'));
    }

    public function edit(Etudiant $etudiant): View
    {
        return view('etudiants.edit', compact('etudiant'));
    }

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

    public function destroy(Etudiant $etudiant): RedirectResponse
    {
        $etudiant->delete();

        return redirect()->route('etudiants.index')->with('status', 'Étudiant supprimé.');
    }
}
