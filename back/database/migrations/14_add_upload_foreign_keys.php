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
            // Vérifier si la colonne existe déjà
            if (!Schema::hasColumn('exercises', 'upload_id')) {
                $table->foreignId('upload_id')->nullable()->constrained('uploads')->onDelete('set null');
            } else {
                // Si la colonne existe mais pas la contrainte de clé étrangère
                try {
                    $table->foreign('upload_id')->references('id')->on('uploads')->onDelete('set null');
                } catch (\Exception $e) {
                    // La contrainte existe déjà ou une autre erreur s'est produite
                }
            }
        });

        // 🇬🇧 Add foreign key in "pages" table referencing "uploads".
        // 🇫🇷 Ajouter une clé étrangère dans la table "pages" vers "uploads".
        Schema::table('pages', function (Blueprint $table) {
            // Vérifier si la colonne existe déjà
            if (!Schema::hasColumn('pages', 'upload_id')) {
                $table->foreignId('upload_id')->nullable()->constrained('uploads')->onDelete('set null');
            } else {
                // Si la colonne existe mais pas la contrainte de clé étrangère
                try {
                    $table->foreign('upload_id')->references('id')->on('uploads')->onDelete('set null');
                } catch (\Exception $e) {
                    // La contrainte existe déjà ou une autre erreur s'est produite
                }
            }
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
            // Vérifier si la contrainte existe
            try {
                $table->dropForeign(['upload_id']);
            } catch (\Exception $e) {
                // La contrainte n'existe pas ou une autre erreur s'est produite
            }
        });

        // 🇬🇧 Remove foreign key from "pages" table.
        // 🇫🇷 Supprimer la clé étrangère de la table "pages".
        Schema::table('pages', function (Blueprint $table) {
            // Vérifier si la contrainte existe
            try {
                $table->dropForeign(['upload_id']);
            } catch (\Exception $e) {
                // La contrainte n'existe pas ou une autre erreur s'est produite
            }
        });
    }
};