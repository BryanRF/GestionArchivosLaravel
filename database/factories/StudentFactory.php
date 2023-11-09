<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
use Illuminate\Support\Str;
use App\Models\Role;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'name' => $this->faker->name,
            'dni' => $this->faker->unique()->regexify('[0-9]{12}'),
            'address' => $this->faker->address,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // Cambia 'password' a la contraseña que desees
            'phone' => $this->faker->phoneNumber,
            'role_id' =>  Role::inRandomOrder()->first()->id,
        ];
    }
}
