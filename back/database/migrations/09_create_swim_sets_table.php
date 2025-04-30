// File: 09_create_swim_sets_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 🇬🇧 Migration to create the "swim_sets" table without foreign key constraints.
 * 🇫🇷 Migration pour créer la table "swim_sets" sans contraintes de clé étrangère.
 */
return new class extends Migration
{
    /**
     * 🇬🇧 Run the migrations.
     * 🇫🇷 Exécuter la migration.
     */
    public function up(): void
    {
        Schema::create('swim_sets', function (Blueprint $table) {
            // 🇬🇧 Primary key (auto-increment).
            // 🇫🇷 Clé primaire (auto-incrémentée).
            $table->bigIncrements('id');

            // 🇬🇧 Foreign key fields without constraints
            // 🇫🇷 Champs de clé étrangère sans contraintes
            $table->unsignedBigInteger('workout_id')->nullable();
            $table->unsignedBigInteger('exercise_id')->nullable();

            // 🇬🇧 Distance of the swim set (optional).
            // 🇫🇷 Distance de la série de natation (optionnelle).
            $table->integer('set_distance')->nullable();

            // 🇬🇧 Number of repetitions (optional).
            // 🇫🇷 Nombre de répétitions (optionnel).
            $table->integer('set_repetition')->nullable();

            // 🇬🇧 Rest time between sets (optional).
            // 🇫🇷 Temps de repos entre les séries (optionnel).
            $table->integer('rest_time')->nullable();

            // 🇬🇧 Timestamps (created_at, updated_at).
            // 🇫🇷 Horodatage (created_at, updated_at).
            $table->timestamps();
        });
    }

    /**
     * 🇬🇧 Reverse the migrations.
     * 🇫🇷 Annuler la migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('swim_sets');
    }
};