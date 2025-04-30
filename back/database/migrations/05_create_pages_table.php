<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 🇬🇧 Migration to create the "pages" table without foreign key constraints.
 * 🇫🇷 Migration pour créer la table "pages" sans contraintes de clé étrangère.
 */
return new class extends Migration
{
    /**
     * 🇬🇧 Run the migrations.
     * 🇫🇷 Exécuter la migration.
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            // 🇬🇧 Primary key (auto-increment).
            // 🇫🇷 Clé primaire (auto-incrémentée).
            $table->bigIncrements('id');

            // 🇬🇧 Title of the page.
            // 🇫🇷 Titre de la page.
            $table->string('title');

            // 🇬🇧 Content of the page.
            // 🇫🇷 Contenu de la page.
            $table->longText('content');

            // 🇬🇧 Page category (optional).
            // 🇫🇷 Catégorie de la page (optionnelle).
            $table->string('page_category')->nullable();

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
        Schema::dropIfExists('pages');
    }
};