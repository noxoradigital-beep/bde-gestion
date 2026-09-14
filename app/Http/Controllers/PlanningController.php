<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlanningController extends Controller
{
    public function index(Request $request): View
    {
        try {
            $mois = $request->has('mois')
                ? Carbon::createFromFormat('Y-m-d', $request->string('mois').'-01')
                : Carbon::now();
        } catch (\Exception) {
            $mois = Carbon::now();
        }

        $mois->startOfMonth();

        $debutGrille = $mois->copy()->startOfWeek(Carbon::MONDAY);
        $finGrille = $mois->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY);

        $evenements = Evenement::whereBetween('date', [$debutGrille, $finGrille])
            ->withCount('etudiants')
            ->orderBy('date')
            ->get()
            ->groupBy(fn (Evenement $evenement) => $evenement->date->format('Y-m-d'));

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
