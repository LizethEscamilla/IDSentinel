<?php

namespace App\Exports;

use App\Models\AccessRecord;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AccessRecordSheet implements FromCollection, WithHeadings, WithStyles, WithTitle
{
    public function collection()
    {
        $records = AccessRecord::with(['teacher', 'subject', 'careerGroup', 'softwareType'])->get();

        return $records->map(function ($record) {
            if ($record->hora_entrada && $record->hora_salida) {
                try {
                    $entrada = Carbon::parse($record->hora_entrada);
                    $salida = Carbon::parse($record->hora_salida);
                    $tiempo_uso = $entrada->diff($salida)->format('%H:%I');
                } catch (\Exception $e) {
                    $tiempo_uso = 'Error';
                }
            } else {
                $tiempo_uso = 'N/A';
            }

            $horaEntrada = $record->hora_entrada ? Carbon::parse($record->hora_entrada)->format('H:i') : 'N/A';
            $horaSalida = $record->hora_salida ? Carbon::parse($record->hora_salida)->format('H:i') : 'N/A';

            return [
                'Docente' => $record->teacher->nombre ?? 'N/A',
                'RFID' => $record->rfid ?? 'N/A',
                'Materia' => $record->subject->nombre ?? 'N/A',
                'Número de Alumnos' => $record->num_alumnos ?? 'N/A',
                'Grupo/Carrera' => $record->careerGroup->nombre ?? 'N/A',
                'Tipo de Uso de Software' => $record->softwareType->nombre ?? 'N/A',
                'Fecha' => $record->fecha ? $record->fecha->format('Y-m-d') : 'N/A',
                'Hora de Entrada' => $horaEntrada,
                'Hora de Salida' => $horaSalida,
                'Tiempo de Uso' => $tiempo_uso,
                'Estado' => $record->estado ?? 'N/A',
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
            'Tiempo de Uso',
            'Estado',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1:1')->getFont()->setBold(true);

        foreach (range('A', $sheet->getHighestColumn()) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }

    public function title(): string
    {
        return 'Accesos';
    }
}
