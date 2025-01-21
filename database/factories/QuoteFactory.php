<?php

namespace Database\Factories;

use App\Models\Board;
use App\Models\Name;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quote>
 */
class QuoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => fake()->date('Y-m-d'),
            'quote' => fake()->paragraph(1, true),
            'favourite' => fake()->boolean(30)
            // name_id, user_id en board_id worden in de seeder toegevoegd
        ];
    }
}
