<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CareerGroup>
 */
class CareerGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $semester = $this->faker->numberBetween(1, 10); // 1 a 10 semestre
        $group = $this->faker->randomElement(['A', 'B', 'C', 'D']); // letras de grupo
        $career = $this->faker->randomElement(['ISC', 'INF']); // nombres de carrera

        return [
            'nombre' => "{$semester}{$group} {$career}",
        ];
    }
}
