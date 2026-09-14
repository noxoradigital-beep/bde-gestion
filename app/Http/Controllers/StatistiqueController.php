<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Evenement;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StatistiqueController extends Controller
{
    public function index(): View
    {
        $totalEtudiants = Etudiant::count();
        $totalEvenements = Evenement::count();

        $tauxParClasse = DB::table('etudiants')
            ->leftJoin('participations', 'participations.etudiant_id', '=', 'etudiants.id')
            ->select('etudiants.classe')
            ->selectRaw('count(distinct etudiants.id) as effectif')
            ->selectRaw('count(distinct case when participations.present = 1 then etudiants.id end) as participants_actifs')
            ->groupBy('etudiants.classe')
            ->orderBy('etudiants.classe')
            ->get();

        $evenementsRecents = Evenement::withCount([
            'etudiants',
            'etudiants as presents_count' => fn ($query) => $query->where('participations.present', true),
        ])->orderByDesc('date')->limit(10)->get();

        return view('statistiques.index', compact(
            'totalEtudiants',
            'totalEvenements',
            'tauxParClasse',
            'evenementsRecents'
        ));
    }
}
