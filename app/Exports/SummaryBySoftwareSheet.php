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

class SummaryBySoftwareSheet implements FromCollection, WithTitle, WithHeadings, WithCharts
{
    public function collection()
    {
        return AccessRecord::selectRaw('software_types.nombre as software, COUNT(*) as total')
            ->join('software_types', 'access_records.software_type_id', '=', 'software_types.id')
            ->groupBy('software_types.nombre')
            ->get()
            ->map(function ($item) {
                return [
                    'software' => $item->software,
                    'total' => $item->total,
                ];
            });
    }

    public function headings(): array
    {
        return ['Software', 'Total de usos'];
    }

    public function title(): string
    {
        return 'Resumen por Software';
    }

    public function charts(): array
    {
        $data = $this->collection();

        $rowCount = $data->count();
        $labelsRange = "'Resumen por Software'!\$A\$2:\$A\$" . ($rowCount + 1);
        $valuesRange = "'Resumen por Software'!\$B\$2:\$B\$" . ($rowCount + 1);

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
        $title = new Title('Distribución de Uso por Software');

        $chart = new Chart(
            'grafico_software',
            $title,
            $legend,
            $plotArea,
            true,
            0,
            null,
            null
        );

        // 📌 Muy importante: ubicación del gráfico en la hoja
        $chart->setTopLeftPosition('D2');
        $chart->setBottomRightPosition('L20');

        return [$chart];
    }
}