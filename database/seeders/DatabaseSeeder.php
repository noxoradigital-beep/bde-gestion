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
    // Commande : php artisan db:seed. Crée un compte de démo admin, 30 faux étudiants,
    // et 5 faux événements avec des participants tirés au sort dessus.
    public function run(): void
    {
        $membreBde = User::factory()->create([
            'name' => 'Membre BDE (démo)',
            'email' => 'demo@bde.local',
            'role' => 'admin',
        ]);

        $etudiants = Etudiant::factory(30)->create();

        Evenement::factory(5)->create(['cree_par' => $membreBde->id])->each(function (Evenement $evenement) use ($etudiants) {
            // Pour chaque événement : entre 5 et 15 participants au hasard, présence/paiement aléatoires.
            $participants = $etudiants->random(random_int(5, 15));
            $payant = (bool) random_int(0, 1);

            $evenement->update([
                'payant' => $payant,
                'prix' => $payant ? fake()->randomElement([3, 5, 8, 10]) : null,
            ]);

            foreach ($participants as $etudiant) {
                $evenement->etudiants()->attach($etudiant->id, [
                    'present' => (bool) random_int(0, 1),
                    'paye' => $payant ? (bool) random_int(0, 1) : false,
                ]);
            }
        });
    }
}
