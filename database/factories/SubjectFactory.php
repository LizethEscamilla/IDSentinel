<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subjects = [
            'Tópicos Avanzados de Programación',
            'Administración de Bases de Datos',
            'Redes de Computadora',
        ];

        return [
            'nombre' => $this->faker->randomElement($subjects),
        ];
    }
}