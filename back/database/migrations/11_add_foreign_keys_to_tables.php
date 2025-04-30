<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 🇬🇧 Migration to add foreign key constraints to various tables.
 * 🇫🇷 Migration pour ajouter des contraintes de clé étrangère à diverses tables.
 */
return new class extends Migration
{
    /**
     * 🇬🇧 Run the migrations.
     * 🇫🇷 Exécuter la migration.
     */
    public function up(): void
    {
        // 🇬🇧 Add foreign keys to uploads table
        // 🇫🇷 Ajouter des clés étrangères à la table uploads
        Schema::table('uploads', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });

        // 🇬🇧 Add foreign keys to exercises table
        // 🇫🇷 Ajouter des clés étrangères à la table exercises
        Schema::table('exercises', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('upload_id')->references('id')->on('uploads')->onDelete('set null');
        });

        // 🇬🇧 Add foreign keys to pages table
        // 🇫🇷 Ajouter des clés étrangères à la table pages
        Schema::table('pages', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('upload_id')->references('id')->on('uploads')->onDelete('set null');
        });

        // 🇬🇧 Add foreign keys to swim_sets table
        // 🇫🇷 Ajouter des clés étrangères à la table swim_sets
        Schema::table('swim_sets', function (Blueprint $table) {
            $table->foreign('workout_id')->references('id')->on('workouts')->onDelete('cascade');
            $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('set null');
        });
    }

    /**
     * 🇬🇧 Reverse the migrations.
     * 🇫🇷 Annuler la migration.
     */
    public function down(): void
    {
        // 🇬🇧 Drop foreign keys from uploads table
        // 🇫🇷 Supprimer les clés étrangères de la table uploads
        Schema::table('uploads', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // 🇬🇧 Drop foreign keys from exercises table
        // 🇫🇷 Supprimer les clés étrangères de la table exercises
        Schema::table('exercises', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['upload_id']);
        });

        // 🇬🇧 Drop foreign keys from pages table
        // 🇫🇷 Supprimer les clés étrangères de la table pages
        Schema::table('pages', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['upload_id']);
        });

        // 🇬🇧 Drop foreign keys from swim_sets table
        // 🇫🇷 Supprimer les clés étrangères de la table swim_sets
        Schema::table('swim_sets', function (Blueprint $table) {
            $table->dropForeign(['workout_id']);
            $table->dropForeign(['exercise_id']);
        });
    }
};