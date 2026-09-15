<?php

namespace App\Models;

use Database\Factories\EvenementFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// Un événement du BDE (nom, date, lieu, payant ou non) et ses participants.
class Evenement extends Model
{
    /** @use HasFactory<EvenementFactory> */
    use HasFactory;

    // Champs qu'on peut remplir directement (ex: Evenement::create([...])).
    protected $fillable = ['nom', 'date', 'lieu', 'description', 'capacite', 'payant', 'prix', 'cree_par'];

    // Convertit automatiquement ces colonnes dans le bon type PHP (date, booléen, nombre décimal).
    protected $casts = [
        'date' => 'datetime',
        'payant' => 'boolean',
        'prix' => 'decimal:2',
    ];

    // Les étudiants inscrits à cet événement, avec leur présence et leur paiement.
    public function etudiants(): BelongsToMany
    {
        return $this->belongsToMany(Etudiant::class, 'participations')
            ->withPivot('present', 'paye')
            ->withTimestamps();
    }

    // Le membre BDE qui a créé l'événement.
    public function createur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cree_par');
    }
}
