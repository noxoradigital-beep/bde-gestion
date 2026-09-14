<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Invitation extends Model
{
    protected $fillable = ['token', 'created_by', 'expires_at', 'used_at', 'used_by'];

    protected $casts = [
        'expires_at' => 'datetime',
        'used_at' => 'datetime',
    ];

    public static function creerPour(User $admin, int $joursValidite = 3): self
    {
        return self::create([
            'token' => Str::random(40),
            'created_by' => $admin->id,
            'expires_at' => Carbon::now()->addDays($joursValidite),
        ]);
    }

    public function estValide(): bool
    {
        return is_null($this->used_at) && $this->expires_at->isFuture();
    }

    public function createur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'used_by');
    }
}
