<?php

namespace App\Models;

use Database\Factories\EvenementFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Evenement extends Model
{
    /** @use HasFactory<EvenementFactory> */
    use HasFactory;

    protected $fillable = ['nom', 'date', 'lieu', 'description', 'capacite', 'cree_par'];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function etudiants(): BelongsToMany
    {
        return $this->belongsToMany(Etudiant::class, 'participations')
            ->withPivot('present')
            ->withTimestamps();
    }

    public function createur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cree_par');
    }
}
