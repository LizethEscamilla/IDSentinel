<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Subject; // Asegúrate de importar el modelo de Materia
use App\Models\CareerGroup; // Asegúrate de importar el modelo de Grupo
use App\Models\SoftwareType; // Asegúrate de importar el modelo de Software
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return view('index', compact('teachers'));
    }

    public function create()
    {
        // Pasamos los datos de materias, grupos y software a la vista de crear
        $subjects = Subject::all();
        $careerGroups = CareerGroup::all();
        $softwareTypes = SoftwareType::all();
        return view('create', compact('subjects', 'careerGroups', 'softwareTypes'));
    }

    public function store(Request $request)
    {
        // Validar la entrada
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'rfid' => 'required|string|max:100',
            'materias' => 'required|array',
            'grupos' => 'required|array',
            'software' => 'required|array',
        ]);
    
        // Crear el docente
        $teacher = Teacher::create([
            'nombre' => $validated['nombre'],
            'rfid' => $validated['rfid'],
        ]);
    
        // Asignar las materias, grupos y software
        $teacher->subjects()->attach($validated['materias']);
        $teacher->careerGroups()->attach($validated['grupos']);
        $teacher->softwareTypes()->attach($validated['software']);
    
        // Redirigir o retornar respuesta
        return redirect()->route('teachers.index')->with('success', 'Docente creado exitosamente');
    }

    public function edit(Teacher $teacher)
    {
        // Pasamos los datos del docente, materias, grupos y software a la vista de editar
        $subjects = Subject::all();
        $careerGroups = CareerGroup::all();
        $softwareTypes = SoftwareType::all();
        return view('edit', compact('teacher', 'subjects', 'careerGroups', 'softwareTypes'));
    }

    public function update(Request $request, Teacher $teacher)
{
    $validated = $request->validate([
        'nombre' => 'required|string|max:255|unique:teachers,nombre,' . $teacher->id,
        'rfid' => 'required|string|max:255|unique:teachers,rfid,' . $teacher->id,
        'materias' => 'required|array',
        'grupos' => 'required|array',
        'software' => 'required|array',
    ]);

    $teacher->update([
        'nombre' => $validated['nombre'],
        'rfid' => $validated['rfid'],
    ]);

    // Usar los nombres correctos de las relaciones:
    $teacher->subjects()->sync($validated['materias']);
    $teacher->careerGroups()->sync($validated['grupos']);
    $teacher->softwareTypes()->sync($validated['software']);

    return redirect()->route('teachers.index')->with('success', 'Docente actualizado correctamente.');
}

    

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Docente eliminado exitosamente');
    }

    public function show(Teacher $teacher)
{
    $teacher->load(['subjects', 'careerGroups', 'softwareTypes']);
    return view('show', compact('teacher'));
}

}