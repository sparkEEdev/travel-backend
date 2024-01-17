<?php

namespace Database\Factories;

use App\Models\Mood;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mood>
 */
class MoodFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Mood::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nature' => fake()->numberBetween(10, 100),
            'relax' => fake()->numberBetween(10, 100),
            'history' => fake()->numberBetween(10, 100),
            'culture' => fake()->numberBetween(10, 100),
            'party' => fake()->numberBetween(10, 100),
        ];
    }
}
