<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 🇬🇧 Migration to add upload foreign keys to related tables.
 * 🇫🇷 Migration pour ajouter des clés étrangères d'upload aux tables associées.
 */
return new class extends Migration
{
    /**
     * 🇬🇧 Run the migrations.
     * 🇫🇷 Exécuter la migration.
     */
    public function up(): void
    {
        // 🇬🇧 Add foreign key in "exercises" table referencing "uploads".
        // 🇫🇷 Ajouter une clé étrangère dans la table "exercises" vers "uploads".
        Schema::table('exercises', function (Blueprint $table) {
            $table->foreignId('upload_id')->nullable()->constrained('uploads')->onDelete('set null');
        });

        // 🇬🇧 Add foreign key in "pages" table referencing "uploads".
        // 🇫🇷 Ajouter une clé étrangère dans la table "pages" vers "uploads".
        Schema::table('pages', function (Blueprint $table) {
            $table->foreignId('upload_id')->nullable()->constrained('uploads')->onDelete('set null');
        });
    }

    /**
     * 🇬🇧 Reverse the migrations.
     * 🇫🇷 Annuler la migration.
     */
    public function down(): void
    {
        // 🇬🇧 Remove foreign key from "exercises" table.
        // 🇫🇷 Supprimer la clé étrangère de la table "exercises".
        Schema::table('exercises', function (Blueprint $table) {
            $table->dropForeign(['upload_id']);
        });

        // 🇬🇧 Remove foreign key from "pages" table.
        // 🇫🇷 Supprimer la clé étrangère de la table "pages".
        Schema::table('pages', function (Blueprint $table) {
            $table->dropForeign(['upload_id']);
        });
    }
};