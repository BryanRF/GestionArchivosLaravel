<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TicketDetail>
 */
use App\Models\TicketDetail;
use App\Models\Ticket;
use App\Models\User;

class TicketDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ticket_id' => Ticket::inRandomOrder()->first()->id, // Asocia un ticket existente o crea uno nuevo y obtén su ID
            'description' => $this->faker->paragraph, // Genera un párrafo de texto aleatorio
            'active' => $this->faker->boolean(80), // Genera un valor booleano (80% de probabilidad de ser verdadero)
        ];
    }
}

