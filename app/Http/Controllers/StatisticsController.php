<?php

namespace App\Http\Controllers;

use App\Models\AccessRecord;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AccessRecordExport;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    // Mostrar las estadísticas (vista)
    public function index()
    {
        // Aquí puedes pasar las estadísticas que quieras mostrar
        // Por ahora solo estamos cargando la vista
        return view('statistics');
    }

    // Exportar los registros de acceso a un archivo Excel
    public function export()
    {
        return Excel::download(new AccessRecordExport, 'accesos.xlsx');
    }
}