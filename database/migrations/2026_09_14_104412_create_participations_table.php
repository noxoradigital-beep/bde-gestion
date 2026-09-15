<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Crée la table "participations" : la table du milieu qui relie un étudiant à un événement
// (un étudiant ne peut être inscrit qu'une fois au même événement grâce au unique() ci-dessous).
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('participations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('evenement_id')->constrained()->cascadeOnDelete();
            $table->boolean('present')->default(false);
            $table->timestamps();

            $table->unique(['etudiant_id', 'evenement_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participations');
    }
};
