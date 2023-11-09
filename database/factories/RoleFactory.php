<?php

namespace Database\Factories;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */

class RoleFactory extends Factory
{
    protected $model = Role::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
//         $jobs = ['Desarrollador de Software', 'Diseñador Gráfico', 'Gerente de Proyectos', 'Analista de Datos'];
        // $jobTitle = $this->faker->randomElement($jobs);
        return [

            'name' => $this->faker->jobTitle,
            'active' => true,
            'is_student' => $this->faker->boolean(80),
        ];
    }
}

