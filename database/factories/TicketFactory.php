<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>fake()->name(),
            'description'=>fake()->text(),
            'status'=>fake()->randomDigit(),
            'assigned_to'=>null,
            'department_id'=>fake()->randomDigit(),
            'category_id'=>fake()->randomDigit(),
            'priority'=>fake()->randomDigit(),
            'user_id'=>fake()->randomDigit(),
        ];
    }
}
