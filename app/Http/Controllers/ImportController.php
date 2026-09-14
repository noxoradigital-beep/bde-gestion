<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ImportController extends Controller
{
    public function create(): View
    {
        return view('etudiants.import');
    }

    /**
     * Import a CSV of students. Expected header row: nom,prenom,email,classe,option
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'fichier' => ['required', 'file', 'mimes:csv,txt'],
        ]);

        $chemin = $request->file('fichier')->getRealPath();
        $handle = fopen($chemin, 'r');

        $entetes = array_map('strtolower', fgetcsv($handle, escape: '\\') ?: []);
        $colonnesAttendues = ['nom', 'prenom', 'email', 'classe', 'option'];

        $importes = 0;
        $ignores = 0;
        $erreurs = [];
        $ligne = 1;

        while (($row = fgetcsv($handle, escape: '\\')) !== false) {
            $ligne++;

            if (count($entetes) !== count($row)) {
                $erreurs[] = "Ligne {$ligne} : nombre de colonnes incorrect.";
                $ignores++;

                continue;
            }

            $donnees = array_combine($entetes, $row);

            if (empty($donnees['nom']) || empty($donnees['prenom']) || empty($donnees['email']) || empty($donnees['classe'])) {
                $erreurs[] = "Ligne {$ligne} : champs obligatoires manquants (nom, prenom, email, classe).";
                $ignores++;

                continue;
            }

            if (! filter_var($donnees['email'], FILTER_VALIDATE_EMAIL)) {
                $erreurs[] = "Ligne {$ligne} : email invalide ({$donnees['email']}).";
                $ignores++;

                continue;
            }

            Etudiant::updateOrCreate(
                ['email' => $donnees['email']],
                [
                    'nom' => $donnees['nom'],
                    'prenom' => $donnees['prenom'],
                    'classe' => $donnees['classe'],
                    'option' => $donnees['option'] ?? null,
                ]
            );

            $importes++;
        }

        fclose($handle);

        return redirect()->route('etudiants.index')->with(
            'status',
            "{$importes} étudiant(s) importé(s), {$ignores} ligne(s) ignorée(s)."
        )->with('erreurs_import', $erreurs);
    }
}
