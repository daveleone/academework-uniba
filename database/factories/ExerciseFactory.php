<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exercise>
 */
class ExerciseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->lastName(),
            'description' => $this->faker->paragraph('2'),
            'points' => $this->faker->numberBetween('1', '10'),
            'type' => $this->faker->randomElement(['close', 'open', 'true/false', 'fill-in'])        
        ];
    }
}
