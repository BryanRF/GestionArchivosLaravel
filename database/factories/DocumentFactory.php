<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Incident;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word , // Genera un nombre aleatorio con extensión .pdf
            'incident_id' => Incident::inRandomOrder()->first()->id, // Asocia un ticket existente o crea uno nuevo y obtén su ID
            'active' => $this->faker->boolean(80), // Genera un valor booleano (80% de probabilidad de ser verdadero)
            'file' => $this->faker->word() . '.pdf', // Genera un nombre de archivo aleatorio en el directorio storage/app/documents
        ];
    }
}
