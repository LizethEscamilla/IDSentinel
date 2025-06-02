<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\AccessRecordSheet;
use App\Exports\SummaryBySubjectSheet;
use App\Exports\SummaryBySoftwareSheet;
use App\Exports\SummaryByGroupSheet;
use App\Exports\GeneralSummarySheet;

class AccessRecordExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new AccessRecordSheet(),           // Registros detallados
            new SummaryBySubjectSheet(),       // Resumen por Materia
            new SummaryBySoftwareSheet(),      // Resumen por Software
            new SummaryByGroupSheet(),         // Resumen por Grupo
            new GeneralSummarySheet(),         // Resumen General
        ];
    }
}