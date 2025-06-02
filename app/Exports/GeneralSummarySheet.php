<?php

namespace App\Exports;

use App\Models\AccessRecord;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCharts;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;

class GeneralSummarySheet implements FromArray, WithTitle, WithStyles, WithCharts
{
    protected array $summaryData = [];

    public function array(): array
    {
        $records = AccessRecord::all();

        $totalRegistros = $records->count();
        $totalAlumnos = $records->sum('num_alumnos');
        $totalHoras = 0;

        foreach ($records as $record) {
            if ($record->hora_entrada && $record->hora_salida) {
                $entrada = Carbon::parse($record->hora_entrada);
                $salida = Carbon::parse($record->hora_salida);
                $horas = $salida->diffInMinutes($entrada) / 60;
                $totalHoras += round($horas, 2);
            }
        }

        $this->summaryData = [
            'Total Registros' => $totalRegistros,
            'Total Alumnos' => $totalAlumnos,
            'Total Horas' => round($totalHoras, 2),
        ];

        return [
            ['RESUMEN GENERAL DE USO'],
            ['Total Registros', 'Total Alumnos', 'Total Horas'],
            array_values($this->summaryData),
        ];
    }

    public function title(): string
    {
        return 'Resumen General';
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:C1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A2:C2')->getFont()->setBold(true);
    }

    public function charts(): array
    {
        // Datos estarán en fila 3: A3, B3, C3
        $labels = [new DataSeriesValues('String', "'Resumen General'!A2:C2", null, 3)];
        $values = [new DataSeriesValues('Number', "'Resumen General'!A3:C3", null, 3)];

        $series = new DataSeries(
            DataSeries::TYPE_PIECHART,
            null,
            range(0, count($values) - 1),
            [],
            $labels,
            $values
        );

        $plotArea = new PlotArea(null, [$series]);
        $legend = new Legend(Legend::POSITION_RIGHT, null, false);
        $title = new Title('Distribución del Resumen General');

        $chart = new Chart(
            'graficaResumen',
            $title,
            $legend,
            $plotArea,
            true,
            0,
            null,
            null
        );

        $chart->setTopLeftPosition('E2');
        $chart->setBottomRightPosition('L20');

        return [$chart];
    }
}