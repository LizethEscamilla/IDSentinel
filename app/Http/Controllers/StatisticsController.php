<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessRecord;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\CareerGroup;
use App\Models\SoftwareType;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AccessRecordExport;

class StatisticsController extends Controller
{
    public function index()
    {
        $records = AccessRecord::with(['subject', 'careerGroup', 'softwareType', 'teacher'])->get();

        // 1. Alumnos por materia
        $alumnosPorMateria = [];
        foreach ($records as $record) {
            $nombreMateria = $record->subject ? $record->subject->nombre : 'Sin materia';
            $alumnosPorMateria[$nombreMateria] = ($alumnosPorMateria[$nombreMateria] ?? 0) + $record->num_alumnos;
        }

        // 2. Alumnos por grupo de carrera
        $alumnosPorGrupo = [];
        foreach ($records as $record) {
            $nombreGrupo = $record->careerGroup ? ($record->careerGroup->nombre ?? 'Sin grupo') : 'Sin grupo';
            $alumnosPorGrupo[$nombreGrupo] = ($alumnosPorGrupo[$nombreGrupo] ?? 0) + $record->num_alumnos;
        }

        // 3. Alumnos por tipo de software
        $alumnosPorSoftware = [];
        foreach ($records as $record) {
            $nombreSoftware = $record->softwareType ? ($record->softwareType->nombre ?? 'Sin software') : 'Sin software';
            $alumnosPorSoftware[$nombreSoftware] = ($alumnosPorSoftware[$nombreSoftware] ?? 0) + $record->num_alumnos;
        }

        // 4. Accesos por día
        $accesosPorDia = [];
        foreach ($records as $record) {
            $fecha = $record->fecha ? Carbon::parse($record->fecha)->format('Y-m-d') : 'Fecha desconocida';
            $accesosPorDia[$fecha] = ($accesosPorDia[$fecha] ?? 0) + 1;
        }
        ksort($accesosPorDia);

        // 5. Horas usadas por profesor
        $horasPorProfesor = [];
        foreach ($records as $record) {
            if ($record->hora_entrada && $record->hora_salida && $record->teacher) {
                $entrada = Carbon::parse($record->hora_entrada);
                $salida = Carbon::parse($record->hora_salida);
                $horas = $salida->diffInMinutes($entrada) / 60;
                $nombreProfesor = $record->teacher->nombre;
                $horasPorProfesor[$nombreProfesor] = ($horasPorProfesor[$nombreProfesor] ?? 0) + $horas;
            }
        }

        $resumenData = [
            'alumnos_por_materia_labels' => array_keys($alumnosPorMateria),
            'alumnos_por_materia_data' => array_values($alumnosPorMateria),

            'alumnos_por_grupo_labels' => array_keys($alumnosPorGrupo),
            'alumnos_por_grupo_data' => array_values($alumnosPorGrupo),

            'alumnos_por_software_labels' => array_keys($alumnosPorSoftware),
            'alumnos_por_software_data' => array_values($alumnosPorSoftware),

            'accesos_por_dia_labels' => array_keys($accesosPorDia),
            'accesos_por_dia_data' => array_values($accesosPorDia),

            'horas_por_profesor_labels' => array_keys($horasPorProfesor),
            'horas_por_profesor_data' => array_map(fn($v) => round($v, 2), array_values($horasPorProfesor)),
        ];

        return view('statistics', compact('resumenData'));
    }

    // Exporta el Excel con múltiples hojas y gráficos
    public function export()
    {
        return Excel::download(
            new AccessRecordExport, 
            'estadisticas.xlsx', 
            \Maatwebsite\Excel\Excel::XLSX, 
            ['includeCharts' => true]
        );
    }
}