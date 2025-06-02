<?php

namespace App\Exports;

use App\Models\AccessRecord;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCharts;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Layout;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;

class SummaryBySubjectSheet implements FromCollection, WithHeadings, WithTitle, WithCharts
{
    protected $data;

    /**
     * Recopila los datos y los resume por materia.
     */
    public function collection()
    {
        $records = AccessRecord::with('subject')->get();

        $summary = [];

        foreach ($records as $record) {
            $subject = $record->subject;

            if ($subject) {
                $subjectName = $subject->nombre;

                if (!isset($summary[$subjectName])) {
                    $summary[$subjectName] = [
                        'Materia' => $subjectName,
                        'Total Accesos' => 0,
                        'Total Alumnos' => 0,
                    ];
                }

                $summary[$subjectName]['Total Accesos'] += 1;
                $summary[$subjectName]['Total Alumnos'] += $record->num_alumnos;
            }
        }

        $this->data = collect(array_values($summary));
        return $this->data;
    }

    /**
     * Encabezados de la hoja de Excel.
     */
    public function headings(): array
    {
        return ['Materia', 'Total Accesos', 'Total Alumnos'];
    }

    /**
     * Título de la hoja.
     */
    public function title(): string
    {
        return 'Resumen por Materia';
    }

    /**
     * Gráfico de pastel que muestra la distribución de accesos por materia.
     */
    public function charts(): array
    {
        $rowCount = $this->data->count();

        $labelsRange = "'Resumen por Materia'!\$A\$2:\$A\$" . ($rowCount + 1);
        $valuesRange = "'Resumen por Materia'!\$B\$2:\$B\$" . ($rowCount + 1);

        $labels = [
            new DataSeriesValues('String', $labelsRange, null, $rowCount),
        ];

        $values = [
            new DataSeriesValues('Number', $valuesRange, null, $rowCount),
        ];

        $series = new DataSeries(
            DataSeries::TYPE_PIECHART,     // Tipo de gráfico
            null,                          // Tipo de agrupamiento
            range(0, count($values) - 1),  // Ejes de serie
            [],                            // Nombres de serie
            $labels,                       // Etiquetas (X)
            $values                        // Valores (Y)
        );

        $plotArea = new PlotArea(null, [$series]);
        $legend = new Legend(Legend::POSITION_RIGHT, null, false);
        $title = new Title('Distribución de Accesos por Materia');

        $chart = new Chart(
            'grafico_materias',
            $title,
            $legend,
            $plotArea,
            true,
            0,
            null,
            null
        );

        $chart->setTopLeftPosition('E2');
        $chart->setBottomRightPosition('M20');

        return [$chart];
    }
}
