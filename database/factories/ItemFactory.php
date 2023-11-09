<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
use App\Models\Item;
use App\Models\Category;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word, // Genera un nombre aleatorio
            'category_id' => Category::inRandomOrder()->first()->id, // Asocia una categoría existente o crea una nueva y obtén su ID
            'active' => $this->faker->boolean(80), // Genera un valor booleano (80% de probabilidad de ser verdadero)
            'description' => $this->faker->paragraph,

        ];
    }
}
