<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Decimal;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'surname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'emp_code' => Str::random(5),
            'start_date' => fake()->dateTimeThisDecade(),
            'address' => fake()->address(),
            'salary' => fake()->randomFloat(2, 10000, 300000),
            'contact_number' => fake()->phoneNumber()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
}
