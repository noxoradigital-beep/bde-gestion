<?php

namespace Database\Seeders;

use App\Models\Etudiant;
use App\Models\Evenement;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database with fake demo data (no real student data).
     */
    public function run(): void
    {
        $membreBde = User::factory()->create([
            'name' => 'Membre BDE (démo)',
            'email' => 'demo@bde.local',
        ]);

        $etudiants = Etudiant::factory(30)->create();

        Evenement::factory(5)->create(['cree_par' => $membreBde->id])->each(function (Evenement $evenement) use ($etudiants) {
            $participants = $etudiants->random(random_int(5, 15));

            foreach ($participants as $etudiant) {
                $evenement->etudiants()->attach($etudiant->id, [
                    'present' => (bool) random_int(0, 1),
                ]);
            }
        });
    }
}
