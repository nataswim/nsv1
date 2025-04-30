<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            // Vérifier si la contrainte existe déjà
            if (!$this->hasConstraint('workouts', 'workouts_user_id_foreign')) {
                Schema::table('workouts', function (Blueprint $table) {
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                });
            }
        }
        
        // 🇬🇧 Add foreign keys to plans table
        // 🇫🇷 Ajouter des clés étrangères à la table plans
        if (Schema::hasTable('plans') && Schema::hasColumn('plans', 'user_id')) {
            // Vérifier si la contrainte existe déjà
            if (!$this->hasConstraint('plans', 'plans_user_id_foreign')) {
                Schema::table('plans', function (Blueprint $table) {
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                });
            }
        }

        // 🇬🇧 Add foreign keys to swim_sets table
        // 🇫🇷 Ajouter des clés étrangères à la table swim_sets
        if (Schema::hasTable('swim_sets')) {
            if (Schema::hasColumn('swim_sets', 'workout_id') && 
                !$this->hasConstraint('swim_sets', 'swim_sets_workout_id_foreign')) {
                Schema::table('swim_sets', function (Blueprint $table) {
                    $table->foreign('workout_id')->references('id')->on('workouts')->onDelete('cascade');
                });
            }
            
            if (Schema::hasColumn('swim_sets', 'exercise_id') && 
                !$this->hasConstraint('swim_sets', 'swim_sets_exercise_id_foreign')) {
                Schema::table('swim_sets', function (Blueprint $table) {
                    $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('set null');
                });
            }
        }
        
        // 🇬🇧 Add foreign keys to mylist table 
        // 🇫🇷 Ajouter des clés étrangères à la table mylist
        if (Schema::hasTable('mylist') && Schema::hasColumn('mylist', 'user_id')) {
            if (!$this->hasConstraint('mylist', 'mylist_user_id_foreign')) {
                Schema::table('mylist', function (Blueprint $table) {
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                });
            }
        }
        
        // 🇬🇧 Check if we need to use my_lists instead of mylist
        // 🇫🇷 Vérifier si nous devons utiliser my_lists au lieu de mylist
        if (!Schema::hasTable('mylist') && Schema::hasTable('my_lists') && Schema::hasColumn('my_lists', 'user_id')) {
            if (!$this->hasConstraint('my_lists', 'my_lists_user_id_foreign')) {
                Schema::table('my_lists', function (Blueprint $table) {
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                });
            }
        }
        
        // 🇬🇧 Add foreign keys to workout_exercises table
        // 🇫🇷 Ajouter des clés étrangères à la table workout_exercises
        if (Schema::hasTable('workout_exercises')) {
            if (Schema::hasColumn('workout_exercises', 'workout_id') && 
                !$this->hasConstraint('workout_exercises', 'workout_exercises_workout_id_foreign')) {
                Schema::table('workout_exercises', function (Blueprint $table) {
                    $table->foreign('workout_id')->references('id')->on('workouts')->onDelete('cascade');
                });
            }
            
            if (Schema::hasColumn('workout_exercises', 'exercise_id') && 
                !$this->hasConstraint('workout_exercises', 'workout_exercises_exercise_id_foreign')) {
                Schema::table('workout_exercises', function (Blueprint $table) {
                    $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');
                });
            }
        }
        
        // 🇬🇧 Add foreign keys to workout_swim_sets table
        // 🇫🇷 Ajouter des clés étrangères à la table workout_swim_sets
        if (Schema::hasTable('workout_swim_sets')) {
            if (Schema::hasColumn('workout_swim_sets', 'workout_id') && 
                !$this->hasConstraint('workout_swim_sets', 'workout_swim_sets_workout_id_foreign')) {
                Schema::table('workout_swim_sets', function (Blueprint $table) {
                    $table->foreign('workout_id')->references('id')->on('workouts')->onDelete('cascade');
                });
            }
            
            if (Schema::hasColumn('workout_swim_sets', 'swim_set_id') && 
                !$this->hasConstraint('workout_swim_sets', 'workout_swim_sets_swim_set_id_foreign')) {
                Schema::table('workout_swim_sets', function (Blueprint $table) {
                    $table->foreign('swim_set_id')->references('id')->on('swim_sets')->onDelete('cascade');
                });
            }
        }
        
        // 🇬🇧 Add foreign keys to plan_workouts table
        // 🇫🇷 Ajouter des clés étrangères à la table plan_workouts
        if (Schema::hasTable('plan_workouts')) {
            if (Schema::hasColumn('plan_workouts', 'plan_id') && 
                !$this->hasConstraint('plan_workouts', 'plan_workouts_plan_id_foreign')) {
                Schema::table('plan_workouts', function (Blueprint $table) {
                    $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
                });
            }
            
            if (Schema::hasColumn('plan_workouts', 'workout_id') && 
                !$this->hasConstraint('plan_workouts', 'plan_workouts_workout_id_foreign')) {
                Schema::table('plan_workouts', function (Blueprint $table) {
                    $table->foreign('workout_id')->references('id')->on('workouts')->onDelete('cascade');
                });
            }
        }
        
        // 🇬🇧 Add foreign keys to mylist_items table
        // 🇫🇷 Ajouter des clés étrangères à la table mylist_items
        if (Schema::hasTable('mylist_items') && Schema::hasColumn('mylist_items', 'mylist_id')) {
            if (!$this->hasConstraint('mylist_items', 'mylist_items_mylist_id_foreign')) {
                if (Schema::hasTable('mylist')) {
                    Schema::table('mylist_items', function (Blueprint $table) {
                        $table->foreign('mylist_id')->references('id')->on('mylist')->onDelete('cascade');
                    });
                } elseif (Schema::hasTable('my_lists')) {
                    Schema::table('mylist_items', function (Blueprint $table) {
                        $table->foreign('mylist_id')->references('id')->on('my_lists')->onDelete('cascade');
                    });
                }
            }
        }
    }

    /**
     * 🇬🇧 Helper method to check if a constraint already exists (compatible with Laravel 11)
     * 🇫🇷 Méthode auxiliaire pour vérifier si une contrainte existe déjà (compatible avec Laravel 11)
     */
    private function hasConstraint($table, $constraintName)
    {
        // Vérifier dans les clés étrangères de la base de données
        $constraints = DB::select(
            "SELECT * FROM information_schema.TABLE_CONSTRAINTS 
            WHERE CONSTRAINT_SCHEMA = DATABASE() 
            AND TABLE_NAME = ? 
            AND CONSTRAINT_NAME = ?",
            [$table, $constraintName]
        );
        
        return count($constraints) > 0;
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
        
        // Et pour les autres tables comme mylist, workout_exercises, workout_swim_sets, plan_workouts, mylist_items,
        // vous pouvez ajouter un code similaire si nécessaire
    }
};