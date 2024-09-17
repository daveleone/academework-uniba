<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Str;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creazione di 10 studenti
        User::factory()->count(10)->create()->each(function ($user) {
            Student::create([
                'user_id' => $user->id,
                'student_number' => Str::random(6),
            ]);
        });
    }
}
