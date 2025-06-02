<?php

namespace App\Exports;

use App\Models\AccessRecord;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCharts;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Layout;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use Carbon\Carbon;

class SummaryByGroupSheet implements FromCollection, WithHeadings, WithTitle, WithCharts
{
    protected $data;

    public function collection()
    {
        $records = AccessRecord::with('careerGroup')->get();

        $summary = [];

        foreach ($records as $record) {
            $group = $record->careerGroup;
            if (!$group) continue;

            $groupName = $group->nombre;

            if (!isset($summary[$groupName])) {
                $summary[$groupName] = [
                    'Grupo/Carrera' => $groupName,
                    'Total Accesos' => 0,
                    'Total Alumnos' => 0,
                    'Total Horas' => 0,
                ];
            }

            $summary[$groupName]['Total Accesos'] += 1;
            $summary[$groupName]['Total Alumnos'] += $record->num_alumnos;

            if ($record->hora_entrada && $record->hora_salida) {
                try {
                    $entrada = Carbon::parse($record->hora_entrada);
                    $salida = Carbon::parse($record->hora_salida);
                    $horas = $salida->diffInMinutes($entrada) / 60;
                    $summary[$groupName]['Total Horas'] += round($horas, 2);
                } catch (\Exception $e) {
                    // Si hay error al parsear fechas, lo ignoramos
                }
            }
        }

        // Guardamos los datos para usarlos luego en charts()
        $this->data = collect(array_values($summary));

        return $this->data;
    }

    public function headings(): array
    {
        return [
            'Grupo/Carrera',
            'Total Accesos',
            'Total Alumnos',
            'Total Horas',
        ];
    }

    public function title(): string
    {
        return 'Resumen por Grupo';
    }

    public function charts(): array
    {
        $rowCount = $this->data->count();
        if ($rowCount === 0) return [];

        $labelsRange = "'Resumen por Grupo'!\$A\$2:\$A\$" . ($rowCount + 1);
        $valuesRange = "'Resumen por Grupo'!\$B\$2:\$B\$" . ($rowCount + 1);

        $labels = [
            new DataSeriesValues('String', $labelsRange, null, $rowCount),
        ];

        $values = [
            new DataSeriesValues('Number', $valuesRange, null, $rowCount),
        ];

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
        $title = new Title('Distribución de Accesos por Grupo');

        $chart = new Chart(
            'grafico_grupo',
            $title,
            $legend,
            $plotArea,
            true,
            0,
            null,
            null
        );

        $chart->setTopLeftPosition('F2');
        $chart->setBottomRightPosition('N20');

        return [$chart];
    }
}