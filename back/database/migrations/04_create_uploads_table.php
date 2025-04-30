// File: 04_create_uploads_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 🇬🇧 Migration to create the "uploads" table without modifying other tables.
 * 🇫🇷 Migration pour créer la table "uploads" sans modifier d'autres tables.
 */
return new class extends Migration
{
    /**
     * 🇬🇧 Run the migrations.
     * 🇫🇷 Exécuter la migration.
     */
    public function up(): void
    {
        Schema::create('uploads', function (Blueprint $table) {
            // 🇬🇧 Primary key (auto-increment).
            // 🇫🇷 Clé primaire (auto-incrémentée).
            $table->bigIncrements('id');

            // 🇬🇧 File name.
            // 🇫🇷 Nom du fichier.
            $table->string('filename');

            // 🇬🇧 File path.
            // 🇫🇷 Chemin du fichier.
            $table->string('path');

            // 🇬🇧 File type (optional).
            // 🇫🇷 Type du fichier (optionnel).
            $table->string('type')->nullable();

            // 🇬🇧 Foreign key reference without constraint
            // 🇫🇷 Référence de clé étrangère sans contrainte
            $table->unsignedBigInteger('user_id')->nullable();

            // 🇬🇧 Timestamps (created_at, updated_at).
            // 🇫🇷 Horodatage (created_at, updated_at).
            $table->timestamps();
        });

        // IMPORTANT: REMOVE THE CODE BELOW THAT MODIFIES OTHER TABLES
        // SUPPRIMER LE CODE CI-DESSOUS QUI MODIFIE D'AUTRES TABLES
        
        // Schema::table('exercises', function (Blueprint $table) {
        //    $table->foreignId('upload_id')->nullable()->constrained('uploads')->onDelete('set null');
        // });
        
        // Schema::table('pages', function (Blueprint $table) {
        //    $table->foreignId('upload_id')->nullable()->constrained('uploads')->onDelete('set null');
        // });
    }

    /**
     * 🇬🇧 Reverse the migrations.
     * 🇫🇷 Annuler la migration.
     */
    public function down(): void
    {
        // IMPORTANT: REMOVE THE CODE BELOW THAT MODIFIES OTHER TABLES
        // SUPPRIMER LE CODE CI-DESSOUS QUI MODIFIE D'AUTRES TABLES
        
        // Schema::table('exercises', function (Blueprint $table) {
        //    $table->dropForeign(['upload_id']);
        // });
        
        // Schema::table('pages', function (Blueprint $table) {
        //    $table->dropForeign(['upload_id']);
        // });

        // 🇬🇧 Drop "uploads" table.
        // 🇫🇷 Supprimer la table "uploads".
        Schema::dropIfExists('uploads');
    }
};