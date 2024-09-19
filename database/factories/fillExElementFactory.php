<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\fillExElement>
 */
class fillExElementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => function (array $attributes) {
                return $attributes['type'] === 'input' ? $this->faker->word() : $this->faker->sentence();
            },
            'type' => $this->faker->randomElement(['text', 'input']),
        ];
    }
}
