<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

// Import d'une liste d'étudiants depuis un fichier CSV.
class ImportController extends Controller
{
    // Formulaire d'import (choix du fichier CSV).
    public function create(): View
    {
        return view('etudiants.import');
    }

    /**
     * Import a CSV of students. Expected header row: nom,prenom,email,classe,option
     */
    // Lit le fichier CSV ligne par ligne, vérifie chaque ligne, puis crée/met à jour les étudiants.
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'fichier' => ['required', 'file', 'mimes:csv,txt'],
        ]);

        $chemin = $request->file('fichier')->getRealPath();
        $handle = fopen($chemin, 'r');

        // Première ligne du fichier = les noms de colonnes (nom, prenom, email, classe, option).
        // Str::ascii() enleve les accents ("Prénom" -> "Prenom") et le BOM UTF-8 ("\xEF\xBB\xBFNom" -> "Nom") :
        // sans ca, reimporter le CSV qu'on vient d'exporter (colonne "Prénom", BOM en tete pour Excel)
        // echouait ligne par ligne, "prenom"/"nom" ne matchant jamais les cles reelles du tableau.
        $entetes = array_map(
            fn ($colonne) => Str::of($colonne)->ascii()->lower()->trim()->toString(),
            fgetcsv($handle, escape: '\\') ?: []
        );
        $colonnesAttendues = ['nom', 'prenom', 'email', 'classe', 'option'];

        $importes = 0;
        $ignores = 0;
        $erreurs = [];
        $ligne = 1;

        // Une itération = une ligne du CSV = un étudiant à importer.
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

            // Si l'email existe déjà, met à jour l'étudiant au lieu d'en créer un doublon.
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
