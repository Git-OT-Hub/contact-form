<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'last_name' => fake()->lastName(),
            'first_name' => fake()->firstName(),
            'gender' => fake()->numberBetween(1, 3),
            'email' => fake()->email(),
            'tel' => fake()->numerify('###########'),
            'address' => fake()->address(),
            'building' => fake()->secondaryAddress(),
            'category_id' => fake()->numberBetween(1, 5),
            'detail' => fake()->realText(100, 5)
        ];
    }
}
