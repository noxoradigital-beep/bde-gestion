<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Ajoute "payant" (oui/non) et "prix" aux événements.
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('evenements', function (Blueprint $table) {
            $table->boolean('payant')->default(false)->after('capacite');
            $table->decimal('prix', 6, 2)->nullable()->after('payant');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evenements', function (Blueprint $table) {
            $table->dropColumn(['payant', 'prix']);
        });
    }
};
