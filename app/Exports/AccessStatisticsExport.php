<?php

namespace App\Exports;

use App\Models\AccessRecord;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AccessStatisticsExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new AccessRecordSheet(),
            new SummaryBySubjectSheet(),
            new SummaryBySoftwareSheet(),
            new SummaryByGroupSheet(),
            new GeneralSummarySheet(),
        ];
    }
}

class AccessRecordSheet implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        $records = AccessRecord::with([
            'teacher.subjects',
            'teacher.careerGroups',
            'teacher.softwareTypes',
            'careerGroup',
            'softwareType'
        ])->get();

        return $records->map(function ($record) {
            return [
                'docente'          => $record->teacher?->nombre ?? 'N/A',
                'rfid'             => $record->rfid,
                'materia'          => $record->teacher ? $record->teacher->subjects->pluck('nombre')->join(', ') : 'N/A',
                'num_alumnos'      => $record->num_alumnos,
                'grupo_carrera'    => $record->teacher ? $record->teacher->careerGroups->pluck('nombre')->join(', ') : 'N/A',
                'tipo_uso_sw'      => $record->teacher ? $record->teacher->softwareTypes->pluck('nombre')->join(', ') : 'N/A',
                'fecha'            => $record->fecha->format('Y-m-d'),
                'hora_entrada'     => $record->hora_entrada->format('H:i:s'),
                'hora_salida'      => $record->hora_salida ? $record->hora_salida->format('H:i:s') : '',
                'estado'           => $record->estado,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Docente',
            'RFID',
            'Materia',
            'Número de Alumnos',
            'Grupo/Carrera',
            'Tipo de Uso de Software',
            'Fecha',
            'Hora de Entrada',
            'Hora de Salida',
            'Estado',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}