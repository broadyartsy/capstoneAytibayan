<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => fake()->password(), // password
            'photo' => fake()->imageUrl('100', '100'),
            'phone' => fake()->unique()->phoneNumber(),
            'barangay' => fake()->streetAddress(),
            'city' => fake()->city(),
            'province' => fake()->country(),
            'zip' => fake()->postcode(),
            'role_id' => fake()->randomElement(['7']),
            'program_id' => fake()->randomElement(['1', '2', '3', '4', '5']),
            'status_id' => fake()->randomElement(['1', '2']),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
