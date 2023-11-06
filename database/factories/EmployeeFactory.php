<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
use App\Models\Employee;
use App\Models\User;
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
            'name' => $this->faker->name,
            'dni' => $this->faker->regexify('[0-9]{12}'),
            'position' => $this->faker->jobTitle,
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'active' => $this->faker->boolean(80),
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'birthdate' => $this->faker->date('Y-m-d', '-18 years')
        ];
    }
}
