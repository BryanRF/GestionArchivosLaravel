<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Incident>
 */
use App\Models\Category;
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
            'user_id' => User::inRandomOrder()->first()->id, // Asocia un empleado existente o crea uno nuevo y obtén su ID
            'employee_id' => Employee::inRandomOrder()->first()->id, // Asocia un empleado existente o crea uno nuevo y obtén su ID
            'item_id' => Item::inRandomOrder()->first()->id, // Asocia un artículo existente o crea uno nuevo y obtén su ID
            'priority' => $this->faker->randomElement(['Alto', 'Medio', 'Bajo']),
            'incident_date' => $this->faker->dateTime(),
            'incident_review' => null, // Puedes ajustar esto según tus necesidades
            'active' => true,
            'status' => $this->faker->randomElement(['Pendiente', 'Revisado', 'Anulado']),
            'category_id' => Category::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];
    }
}
