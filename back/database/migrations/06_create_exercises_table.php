<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 🇬🇧 Migration to create the "exercises" table without foreign key constraints.
 * 🇫🇷 Migration pour créer la table "exercises" sans contraintes de clé étrangère.
 */
return new class extends Migration
{
    /**
     * 🇬🇧 Run the migrations.
     * 🇫🇷 Exécuter la migration.
     */
    public function up(): void
    {
        Schema::create('exercises', function (Blueprint $table) {
            // 🇬🇧 Primary key (auto-increment).
            // 🇫🇷 Clé primaire (auto-incrémentée).
            $table->bigIncrements('id');

            // 🇬🇧 Title of the exercise.
            // 🇫🇷 Titre de l'exercice.
            $table->string('title');

            // 🇬🇧 Description of the exercise (optional).
            // 🇫🇷 Description de l'exercice (optionnelle).
            $table->text('description')->nullable();

            // 🇬🇧 Exercise level (optional).
            // 🇫🇷 Niveau de l'exercice (optionnel).
            $table->string('exercise_level')->nullable();

            // 🇬🇧 Exercise category (optional).
            // 🇫🇷 Catégorie de l'exercice (optionnelle).
            $table->string('exercise_category')->nullable();

            // 🇬🇧 Foreign key fields without constraints
            // 🇫🇷 Champs de clé étrangère sans contraintes
            $table->unsignedBigInteger('upload_id')->nullable();
            $table->unsignedBigInteger('user_id');

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
        Schema::dropIfExists('exercises');
    }
};