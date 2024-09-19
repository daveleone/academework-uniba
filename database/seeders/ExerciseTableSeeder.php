<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exercise;
use App\Models\tfExElement;
use App\Models\openExElement;
use App\Models\closedExElement;
use App\Models\fillExElement;
use Faker\Factory as Faker;

class ExerciseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = User::whereHas('teacher')->get();
        foreach ($teachers as $teacher) {
            Subject::factory()->count(5)->create([
                'teacher_id' => $teacher->id
            ])->each(function ($subject) {
                Topic::factory()->count(3)->create([
                    'subject_id' => $subject->id
                ])->each(function ($topic) {
                    Exercise::factory()->count(4)->create(
                        ['topic_id' => $topic->id]
                    );
                });
            });
        }

        $exercises = Exercise::get();

        foreach ($exercises as $exercise) {
            switch ($exercise->type) {
                case 'true/false':
                    for ($i = 0; $i <= rand(2, 6); $i++)
                        tfExElement::factory()->create([
                            'exercise_id' => $exercise->id,
                            'position' => $i
                        ]);
                    break;

                case 'open':
                    openExElement::factory()->create([
                        'exercise_id' => $exercise->id,
                    ]);
                    break;

                case 'close':
                    $nAns = rand(2, 6);
                    $trueAns = rand(0, $nAns);
                    for ($i = 0; $i <= $nAns; $i++)
                        closedExElement::factory()->create([
                            'exercise_id' => $exercise->id,
                            'position' => $i,
                            'truth' => ($i == $trueAns)
                        ]);
                    break;

                case 'fill-in':
                    $faker = Faker::create();
                    for ($i = 0, $previousType = null; $i <= rand(2, 6); $i++) {
                        if ($previousType === 'input') {
                            $type = 'text';
                        } else {
                            $type = $faker->randomElement(['text', 'input']);
                        }

                        fillExElement::factory()->create([
                            'exercise_id' => $exercise->id,
                            'position' => $i,
                            'type' => $type,
                            'content' => $type === 'input' ? $faker->word() : $faker->sentence(), // Genera contenuto in base al tipo
                        ]);

                        $previousType = $type;
                    }
                    break;
            }
        }
    }
}
