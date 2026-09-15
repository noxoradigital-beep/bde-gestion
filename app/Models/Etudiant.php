<?php

namespace App\Models;

use Database\Factories\EtudiantFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// Un étudiant (nom, prénom, email, classe, option) et les événements auxquels il participe.
class Etudiant extends Model
{
    /** @use HasFactory<EtudiantFactory> */
    use HasFactory;

    // Champs qu'on peut remplir directement (ex: Etudiant::create([...])).
    protected $fillable = ['nom', 'prenom', 'email', 'classe', 'option'];

    // Les événements de cet étudiant, avec sa présence sur chacun (table "participations" au milieu).
    public function evenements(): BelongsToMany
    {
        return $this->belongsToMany(Evenement::class, 'participations')
            ->withPivot('present')
            ->withTimestamps();
    }
}
