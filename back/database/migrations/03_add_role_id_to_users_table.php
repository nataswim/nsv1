<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 🇬🇧 Migration to add foreign key constraint to the "role_id" column in the "users" table.
 * 🇫🇷 Migration pour ajouter la contrainte de clé étrangère à la colonne "role_id" dans la table "users".
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
            // 🇬🇧 Add foreign key constraint to the existing "role_id" column.
            // 🇫🇷 Ajouter la contrainte de clé étrangère à la colonne "role_id" existante.
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
        });

        Schema::table('sessions', function (Blueprint $table) {
            // 🇬🇧 Add foreign key constraint to the existing "user_id" column.
            // 🇫🇷 Ajouter la contrainte de clé étrangère à la colonne "user_id" existante.
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * 🇬🇧 Reverse the migrations.
     * 🇫🇷 Annuler la migration.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 🇬🇧 Drop foreign key constraint.
            // 🇫🇷 Supprimer la contrainte de clé étrangère.
            $table->dropForeign(['role_id']);
        });

        Schema::table('sessions', function (Blueprint $table) {
            // 🇬🇧 Drop foreign key constraint.
            // 🇫🇷 Supprimer la contrainte de clé étrangère.
            $table->dropForeign(['user_id']);
        });
    }
};
