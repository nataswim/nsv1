<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 🇬🇧 Migration to remove the "old_name" column from the "users" table if it exists.
 * 🇫🇷 Migration pour supprimer la colonne "old_name" de la table "users" si elle existe.
 */
return new class extends Migration
{
    /**
     * 🇬🇧 Run the migrations.
     * 🇫🇷 Exécuter la migration.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 🇬🇧 Remove the "old_name" column only if it exists.
            // 🇫🇷 Supprimer la colonne "old_name" seulement si elle existe.
            if (Schema::hasColumn('users', 'old_name')) {
                $table->dropColumn('old_name');
            }
        });
    }

    /**
     * 🇬🇧 Reverse the migrations.
     * 🇫🇷 Annuler la migration.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 🇬🇧 Restore the "old_name" column (nullable) if it doesn't exist.
            // 🇫🇷 Restaurer la colonne "old_name" (nullable) si elle n'existe pas.
            if (!Schema::hasColumn('users', 'old_name')) {
                $table->string('old_name')->nullable();
            }
        });
    }
};