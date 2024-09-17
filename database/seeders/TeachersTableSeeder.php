<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creazione di 5 professori
        User::factory()->count(5)->create()->each(function ($user) {
            Teacher::create([
                'user_id' => $user->id,
            ]);
        });
    }
}
