<?php

namespace App\Http\Controllers;

use App\Models\AccessRecord;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\CareerGroup;
use App\Models\SoftwareType;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AccessRecordController extends Controller
{
    public function index()
    {
        // Obtener todos los registros de acceso con relaciones
        $accessRecords = AccessRecord::with([
            'teacher',
            'subject',
            'careerGroup',
            'softwareType'
        ])->get();

        // Calcular el tiempo de uso del software solo si hay hora_entrada y hora_salida
        foreach ($accessRecords as $record) {
            if ($record->hora_entrada && $record->hora_salida) {
                try {
                    $entrada = Carbon::parse($record->hora_entrada);
                    $salida = Carbon::parse($record->hora_salida);
                    $record->tiempo_uso = $entrada->diff($salida)->format('%H:%I');
                } catch (\Exception $e) {
                    $record->tiempo_uso = 'Error';
                }
            } else {
                $record->tiempo_uso = 'N/A'; // O puedes usar 'N/A' si prefieres
            }
        }

        // Obtener catálogos para la vista
        $teachers = Teacher::all();
        $subjects = Subject::all();
        $careerGroups = CareerGroup::all();
        $softwareTypes = SoftwareType::all();

        return view('access', compact(
            'accessRecords',
            'teachers',
            'subjects',
            'careerGroups',
            'softwareTypes'
        ));
    }
}
