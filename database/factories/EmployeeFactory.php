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
            'name' => $this->faker->name, // Genera un nombre aleatorio
            'position' => $this->faker->jobTitle, // Genera un cargo aleatorio
            'user_id' => function () {
                return User::inRandomOrder()->first()->id; // Asocia un usuario existente o crea uno nuevo y obtén su ID
            },
            'active' => $this->faker->boolean(80) // Genera un valor booleano (80% de probabilidad de ser verdadero)
        ];
    }
}
