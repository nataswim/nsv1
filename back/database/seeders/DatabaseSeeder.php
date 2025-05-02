<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * 🇬🇧 DatabaseSeeder class responsible for seeding the database with initial data.
 * 🇫🇷 Classe DatabaseSeeder responsable du peuplement de la base de données avec des données initiales.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * 🇬🇧 Seed the application's database.
     * 🇫🇷 Peupler la base de données de l'application.
     */
    public function run(): void
    {
        // 🇬🇧 Example of user seeding with factory
        // 🇫🇷 Exemple de création d'utilisateurs avec une factory
        // \App\Models\User::factory(10)->create();

        // 🇬🇧 Example of creating a specific user
        // 🇫🇷 Exemple de création d'un utilisateur spécifique
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            UploadSeeder::class,
            ExerciseSeeder::class,
            PageSeeder::class,
            PlanSeeder::class,
            WorkoutSeeder::class,
            SwimSetSeeder::class,
            MylistSeeder::class,
            MylistItemSeeder::class,
            PlanWorkoutSeeder::class,
            WorkoutExerciseSeeder::class,
            WorkoutSwimSetSeeder::class,
        ]);
    }
}
