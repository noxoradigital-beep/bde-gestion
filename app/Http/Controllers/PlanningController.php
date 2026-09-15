<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

// Construit la grille du calendrier mensuel (page "Planning") avec les événements de chaque jour.
class PlanningController extends Controller
{
    public function index(Request $request): View
    {
        // Détermine le mois à afficher (celui demandé dans l'URL, sinon le mois actuel).
        try {
            $mois = $request->has('mois')
                ? Carbon::createFromFormat('Y-m-d', $request->string('mois').'-01')
                : Carbon::now();
        } catch (\Exception) {
            $mois = Carbon::now();
        }

        $mois->startOfMonth();

        // La grille commence le lundi de la 1ère semaine et finit le dimanche de la dernière
        // (donc elle déborde un peu sur le mois précédent/suivant, comme un vrai calendrier).
        $debutGrille = $mois->copy()->startOfWeek(Carbon::MONDAY);
        $finGrille = $mois->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY);

        // Récupère tous les événements de la période, regroupés par jour (date -> événements).
        $evenements = Evenement::whereBetween('date', [$debutGrille, $finGrille])
            ->withCount('etudiants')
            ->orderBy('date')
            ->get()
            ->groupBy(fn (Evenement $evenement) => $evenement->date->format('Y-m-d'));

        // Construit la grille jour par jour, semaine par semaine, pour l'affichage dans la vue.
        $semaines = [];
        $curseur = $debutGrille->copy();

        while ($curseur->lte($finGrille)) {
            $semaine = [];

            for ($i = 0; $i < 7; $i++) {
                $semaine[] = [
                    'date' => $curseur->copy(),
                    'horsMois' => ! $curseur->isSameMonth($mois),
                    'aujourdhui' => $curseur->isToday(),
                    'evenements' => $evenements->get($curseur->format('Y-m-d'), collect()),
                ];
                $curseur->addDay();
            }

            $semaines[] = $semaine;
        }

        return view('planning.index', [
            'mois' => $mois,
            'semaines' => $semaines,
            'moisPrecedent' => $mois->copy()->subMonthNoOverflow()->format('Y-m'),
            'moisSuivant' => $mois->copy()->addMonthNoOverflow()->format('Y-m'),
        ]);
    }
}
