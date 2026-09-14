<?php

namespace App\Models;

use Database\Factories\EtudiantFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Etudiant extends Model
{
    /** @use HasFactory<EtudiantFactory> */
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'email', 'classe', 'option'];

    public function evenements(): BelongsToMany
    {
        return $this->belongsToMany(Evenement::class, 'participations')
            ->withPivot('present')
            ->withTimestamps();
    }
}
