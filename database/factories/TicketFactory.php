<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
use App\Models\Ticket;
use App\Models\Category;
use App\Models\User;

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
            'user_id' => User::inRandomOrder()->first()->id, // Asocia un usuario existente o crea uno nuevo y obtén su ID
            'category_id' => Category::inRandomOrder()->first()->id, // Asocia una categoría existente o crea una nueva y obtén su ID
            'title' => $this->faker->sentence, // Genera una oración aleatoria
            'description' => $this->faker->paragraph, // Genera un párrafo de texto aleatorio
            'status' => $this->faker->randomElement(['Pendiente', 'En Proceso', 'Resuelto', 'Cerrado']), // Elige un estado aleatorio
            'active' => $this->faker->boolean(80), // Genera un valor booleano (80% de probabilidad de ser verdadero)
        ];
    }
}

