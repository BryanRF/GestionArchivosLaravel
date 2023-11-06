<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Incident>
 */
use App\Models\Incident;
use App\Models\Employee;
use App\Models\User;
use App\Models\Item;
use Carbon\Carbon;

class IncidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $incidentDate = $this->faker->dateTimeBetween('-1 year', 'now');

        return [
            'ticket_id' => Ticket::inRandomOrder()->first()->id, // Asocia un empleado existente o crea uno nuevo y obtén su ID
            'user_id' => User::inRandomOrder()->first()->id, // Asocia un empleado existente o crea uno nuevo y obtén su ID
            'employee_id' => Employee::inRandomOrder()->first()->id, // Asocia un empleado existente o crea uno nuevo y obtén su ID
            'item_id' => Item::inRandomOrder()->first()->id, // Asocia un artículo existente o crea uno nuevo y obtén su ID
            'description' => $this->faker->sentence,
            'incident_date' => $incidentDate,
            'status' => $this->faker->randomElement(['Pendiente', 'Revisado', 'Anulado']),
            'active' => $this->faker->boolean(80), // Genera un valor booleano (80% de probabilidad de ser verdadero)
            'created_at' => $incidentDate,
            'updated_at' => $incidentDate
        ];
    }
}
