<?php

namespace App\Exports;

use App\Models\AccessRecord;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AccessRecordExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return AccessRecord::select([
            'docente', 'rfid', 'materia', 'num_alumnos',
            'grupo_carrera', 'tipo_uso_sw', 'fecha', 'hora_entrada',
            'hora_salida', 'estado'
        ])->get();
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
            'Estado'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Fila 1 en negrita
        ];
    }
}

