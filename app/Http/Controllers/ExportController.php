<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Evenement;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function etudiants(): StreamedResponse
    {
        return $this->exporterCsv('etudiants.csv', ['Nom', 'Prénom', 'Email', 'Classe', 'Option'], function ($sortie) {
            Etudiant::orderBy('nom')->chunk(200, function ($etudiants) use ($sortie) {
                foreach ($etudiants as $etudiant) {
                    fputcsv($sortie, [$etudiant->nom, $etudiant->prenom, $etudiant->email, $etudiant->classe, $etudiant->option]);
                }
            });
        });
    }

    public function evenements(): StreamedResponse
    {
        return $this->exporterCsv('evenements.csv', ['Nom', 'Date', 'Lieu', 'Participants', 'Présents'], function ($sortie) {
            Evenement::withCount([
                'etudiants',
                'etudiants as presents_count' => fn ($query) => $query->where('participations.present', true),
            ])->orderByDesc('date')->chunk(200, function ($evenements) use ($sortie) {
                foreach ($evenements as $evenement) {
                    fputcsv($sortie, [
                        $evenement->nom,
                        $evenement->date->format('d/m/Y H:i'),
                        $evenement->lieu,
                        $evenement->etudiants_count,
                        $evenement->presents_count,
                    ]);
                }
            });
        });
    }

    public function paiements(Evenement $evenement): StreamedResponse
    {
        $nomFichier = 'paiements-'.$evenement->id.'.csv';

        return $this->exporterCsv($nomFichier, ['Étudiant', 'Classe', 'A payé', 'Montant'], function ($sortie) use ($evenement) {
            foreach ($evenement->etudiants as $etudiant) {
                fputcsv($sortie, [
                    $etudiant->nom.' '.$etudiant->prenom,
                    $etudiant->classe,
                    $etudiant->pivot->paye ? 'Oui' : 'Non',
                    $etudiant->pivot->paye ? number_format((float) $evenement->prix, 2, ',', '') : '',
                ]);
            }
        });
    }

    private function exporterCsv(string $nomFichier, array $entetes, callable $ecrireLignes): StreamedResponse
    {
        $callback = function () use ($entetes, $ecrireLignes) {
            $sortie = fopen('php://output', 'w');
            fwrite($sortie, "\xEF\xBB\xBF"); // BOM UTF-8 pour Excel
            fputcsv($sortie, $entetes);
            $ecrireLignes($sortie);
            fclose($sortie);
        };

        return response()->streamDownload($callback, $nomFichier, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
