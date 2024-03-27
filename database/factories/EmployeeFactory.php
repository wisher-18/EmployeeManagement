<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'guid' => Str::uuid(), 
            'employee_name' => $this->faker->name,
            'employee_email' => $this->faker->unique()->safeEmail,
            'dob' => $this->faker->date,
            'department' => $this->faker->randomElement(['HR', 'Finance', 'IT']),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'designation' => $this->faker->jobTitle,
            'is_active' => $this->faker->boolean,
        ];
    }
}
