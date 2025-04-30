// File: 15_add_foreign_keys_to_tables.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 🇬🇧 Migration to add all foreign key constraints to the application tables.
 * 🇫🇷 Migration pour ajouter toutes les contraintes de clé étrangère aux tables de l'application.
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

        // 🇬🇧 Add foreign keys to workouts table
        // 🇫🇷 Ajouter des clés étrangères à la table workouts
        if (Schema::hasTable('workouts') && Schema::hasColumn('workouts', 'user_id')) {
            Schema::table('workouts', function (Blueprint $table) {
                // Vérifier si la contrainte existe déjà
                if (!$this->hasConstraint('workouts', 'workouts_user_id_foreign')) {
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                }
            });
        }
        
        // 🇬🇧 Add foreign keys to plans table
        // 🇫🇷 Ajouter des clés étrangères à la table plans
        if (Schema::hasTable('plans') && Schema::hasColumn('plans', 'user_id')) {
            Schema::table('plans', function (Blueprint $table) {
                // Vérifier si la contrainte existe déjà
                if (!$this->hasConstraint('plans', 'plans_user_id_foreign')) {
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                }
            });
        }

        // 🇬🇧 Add foreign keys to swim_sets table
        // 🇫🇷 Ajouter des clés étrangères à la table swim_sets
        if (Schema::hasTable('swim_sets')) {
            Schema::table('swim_sets', function (Blueprint $table) {
                if (Schema::hasColumn('swim_sets', 'workout_id')) {
                    $table->foreign('workout_id')->references('id')->on('workouts')->onDelete('cascade');
                }
                if (Schema::hasColumn('swim_sets', 'exercise_id')) {
                    $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('set null');
                }
            });
        }
        
        // 🇬🇧 Add foreign keys to mylist table 
        // 🇫🇷 Ajouter des clés étrangères à la table mylist
        if (Schema::hasTable('mylist') && Schema::hasColumn('mylist', 'user_id')) {
            Schema::table('mylist', function (Blueprint $table) {
                if (!$this->hasConstraint('mylist', 'mylist_user_id_foreign')) {
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                }
            });
        }
        
        // 🇬🇧 Check if we need to use my_lists instead of mylist
        // 🇫🇷 Vérifier si nous devons utiliser my_lists au lieu de mylist
        if (!Schema::hasTable('mylist') && Schema::hasTable('my_lists') && Schema::hasColumn('my_lists', 'user_id')) {
            Schema::table('my_lists', function (Blueprint $table) {
                if (!$this->hasConstraint('my_lists', 'my_lists_user_id_foreign')) {
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                }
            });
        }
        
        // 🇬🇧 Add foreign keys to workout_exercises table
        // 🇫🇷 Ajouter des clés étrangères à la table workout_exercises
        if (Schema::hasTable('workout_exercises')) {
            Schema::table('workout_exercises', function (Blueprint $table) {
                if (Schema::hasColumn('workout_exercises', 'workout_id') && 
                    !$this->hasConstraint('workout_exercises', 'workout_exercises_workout_id_foreign')) {
                    $table->foreign('workout_id')->references('id')->on('workouts')->onDelete('cascade');
                }
                if (Schema::hasColumn('workout_exercises', 'exercise_id') && 
                    !$this->hasConstraint('workout_exercises', 'workout_exercises_exercise_id_foreign')) {
                    $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');
                }
            });
        }
        
        // 🇬🇧 Add foreign keys to workout_swim_sets table
        // 🇫🇷 Ajouter des clés étrangères à la table workout_swim_sets
        if (Schema::hasTable('workout_swim_sets')) {
            Schema::table('workout_swim_sets', function (Blueprint $table) {
                if (Schema::hasColumn('workout_swim_sets', 'workout_id') && 
                    !$this->hasConstraint('workout_swim_sets', 'workout_swim_sets_workout_id_foreign')) {
                    $table->foreign('workout_id')->references('id')->on('workouts')->onDelete('cascade');
                }
                if (Schema::hasColumn('workout_swim_sets', 'swim_set_id') && 
                    !$this->hasConstraint('workout_swim_sets', 'workout_swim_sets_swim_set_id_foreign')) {
                    $table->foreign('swim_set_id')->references('id')->on('swim_sets')->onDelete('cascade');
                }
            });
        }
        
        // 🇬🇧 Add foreign keys to plan_workouts table
        // 🇫🇷 Ajouter des clés étrangères à la table plan_workouts
        if (Schema::hasTable('plan_workouts')) {
            Schema::table('plan_workouts', function (Blueprint $table) {
                if (Schema::hasColumn('plan_workouts', 'plan_id') && 
                    !$this->hasConstraint('plan_workouts', 'plan_workouts_plan_id_foreign')) {
                    $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
                }
                if (Schema::hasColumn('plan_workouts', 'workout_id') && 
                    !$this->hasConstraint('plan_workouts', 'plan_workouts_workout_id_foreign')) {
                    $table->foreign('workout_id')->references('id')->on('workouts')->onDelete('cascade');
                }
            });
        }
        
        // 🇬🇧 Add foreign keys to mylist_items table
        // 🇫🇷 Ajouter des clés étrangères à la table mylist_items
        if (Schema::hasTable('mylist_items') && Schema::hasColumn('mylist_items', 'mylist_id')) {
            Schema::table('mylist_items', function (Blueprint $table) {
                if (!$this->hasConstraint('mylist_items', 'mylist_items_mylist_id_foreign')) {
                    if (Schema::hasTable('mylist')) {
                        $table->foreign('mylist_id')->references('id')->on('mylist')->onDelete('cascade');
                    } elseif (Schema::hasTable('my_lists')) {
                        $table->foreign('mylist_id')->references('id')->on('my_lists')->onDelete('cascade');
                    }
                }
            });
        }
    }

    /**
     * 🇬🇧 Helper method to check if a constraint already exists
     * 🇫🇷 Méthode auxiliaire pour vérifier si une contrainte existe déjà
     */
    private function hasConstraint($table, $constraintName)
    {
        $conn = Schema::getConnection();
        $dbSchemaManager = $conn->getDoctrineSchemaManager();
        $doctrineTable = $dbSchemaManager->listTableDetails($table);
        
        return $doctrineTable->hasIndex($constraintName);
    }

    /**
     * 🇬🇧 Reverse the migrations.
     * 🇫🇷 Annuler la migration.
     */
    public function down(): void
    {
        // 🇬🇧 Drop foreign keys from uploads table
        // 🇫🇷 Supprimer les clés étrangères de la table uploads
        if (Schema::hasTable('uploads')) {
            Schema::table('uploads', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }

        // 🇬🇧 Drop foreign keys from exercises table
        // 🇫🇷 Supprimer les clés étrangères de la table exercises
        if (Schema::hasTable('exercises')) {
            Schema::table('exercises', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropForeign(['upload_id']);
            });
        }

        // 🇬🇧 Drop foreign keys from pages table
        // 🇫🇷 Supprimer les clés étrangères de la table pages
        if (Schema::hasTable('pages')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropForeign(['upload_id']);
            });
        }

        // Même chose pour les autres tables...
        // Code similaire pour supprimer les clés étrangères des autres tables
        
        // workouts
        if (Schema::hasTable('workouts')) {
            Schema::table('workouts', function (Blueprint $table) {
                if (Schema::hasColumn('workouts', 'user_id')) {
                    $table->dropForeign(['user_id']);
                }
            });
        }
        
        // plans
        if (Schema::hasTable('plans')) {
            Schema::table('plans', function (Blueprint $table) {
                if (Schema::hasColumn('plans', 'user_id')) {
                    $table->dropForeign(['user_id']);
                }
            });
        }
        
        // swim_sets
        if (Schema::hasTable('swim_sets')) {
            Schema::table('swim_sets', function (Blueprint $table) {
                if (Schema::hasColumn('swim_sets', 'workout_id')) {
                    $table->dropForeign(['workout_id']);
                }
                if (Schema::hasColumn('swim_sets', 'exercise_id')) {
                    $table->dropForeign(['exercise_id']);
                }
            });
        }
        
        // Et les autres tables (mylist, workout_exercises, workout_swim_sets, plan_workouts, mylist_items)
        // ...
    }
};