<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

// Un lien d'invitation à usage unique, qui permet de créer un compte membre BDE
// (l'inscription libre est fermée, il faut être invité par un admin).
class Invitation extends Model
{
    protected $fillable = ['token', 'created_by', 'expires_at', 'used_at', 'used_by'];

    protected $casts = [
        'expires_at' => 'datetime',
        'used_at' => 'datetime',
    ];

    // Crée une nouvelle invitation avec un code aléatoire, valable X jours (3 par défaut).
    public static function creerPour(User $admin, int $joursValidite = 3): self
    {
        return self::create([
            'token' => Str::random(40),
            'created_by' => $admin->id,
            'expires_at' => Carbon::now()->addDays($joursValidite),
        ]);
    }

    // Vrai si l'invitation n'a pas encore été utilisée ET n'est pas expirée.
    public function estValide(): bool
    {
        return is_null($this->used_at) && $this->expires_at->isFuture();
    }

    // L'admin qui a généré cette invitation.
    public function createur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // La personne qui a utilisé cette invitation pour s'inscrire (si utilisée).
    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'used_by');
    }
}
