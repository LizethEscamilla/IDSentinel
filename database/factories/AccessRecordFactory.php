<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Teacher;       // Importa el modelo Teacher
use App\Models\Subject;       // Importa el modelo Subject
use App\Models\CareerGroup;   // Importa el modelo CareerGroup
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
        $entryTime = $this->faker->dateTimeThisYear(); // Asegúrate de definir la variable $entryTime
        $estado = $this->faker->randomElement(['libre', 'ocupado']); // Suponiendo que el estado puede ser 'libre' u 'ocupado'

        return [
            'docente' => Teacher::inRandomOrder()->first()->nombre,
            'rfid' => $this->faker->unique()->bothify('RFID-####'),
            'materia' => Subject::inRandomOrder()->first()->nombre,
            'num_alumnos' => $this->faker->numberBetween(10, 40),
            'grupo_carrera' => CareerGroup::inRandomOrder()->first()->nombre,
            'tipo_uso_sw' => SoftwareType::inRandomOrder()->first()->nombre,
            'fecha' => $this->faker->date(),
            'hora_entrada' => $entryTime->format('H:i:s'),
            'hora_salida' => $estado === 'libre'
                ? (clone $entryTime)->modify('+1 hour')->format('H:i:s')
                : null,
            'estado' => $estado,
        ];
    }
}
