<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// Table de liaison entre un étudiant et un événement : est-il présent ? a-t-il payé ?
// (Etudiant et Evenement l'utilisent déjà via belongsToMany, ce modèle sert surtout aux relations directes.)
class Participation extends Model
{
    protected $fillable = ['etudiant_id', 'evenement_id', 'present', 'paye'];

    protected $casts = [
        'present' => 'boolean',
        'paye' => 'boolean',
    ];

    public function etudiant(): BelongsTo
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function evenement(): BelongsTo
    {
        return $this->belongsTo(Evenement::class);
    }
}
