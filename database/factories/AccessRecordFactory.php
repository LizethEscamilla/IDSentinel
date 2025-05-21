<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\CareerGroup;
use App\Models\SoftwareType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccessRecord>
 */
class AccessRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generar una hora de entrada aleatoria
        $entryTime = $this->faker->dateTimeThisYear(); 
        $estado = $this->faker->randomElement(['libre', 'ocupado']); 

        return [
            'teacher_id' => Teacher::inRandomOrder()->first()->id,
            'rfid' => $this->faker->unique()->bothify('RFID-####'),
            'subject_id' => Subject::inRandomOrder()->first()->id,
            'num_alumnos' => $this->faker->numberBetween(10, 40),
            'career_group_id' => CareerGroup::inRandomOrder()->first()->id,
            'software_type_id' => SoftwareType::inRandomOrder()->first()->id,
            'fecha' => $this->faker->date(),
            'hora_entrada' => $entryTime->format('H:i:s'),
            'hora_salida' => $estado === 'libre'
                ? (clone $entryTime)->modify('+1 hour')->format('H:i:s')
                : null,
            'estado' => $estado,
        ];
    }
}