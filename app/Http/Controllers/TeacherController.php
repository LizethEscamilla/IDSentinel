<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Support\Facades\File;


class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers=Teacher::all();
        return view('index', compact('teachers'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $teacher = new Teacher();
        $teacher->nombre = $request->input('nombre');
        $teacher->save();

        return redirect()->route('teachers.index')->with('success', 'Docente guardado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return view('show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view ('edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Encuentra el docente por su ID
    $teacher = Teacher::find($id);

    // Si el docente no existe, redirige o muestra un error
    if (!$teacher) {
        return redirect()->route('teachers.index')->with('error', 'Docente no encontrado');
    }

    // Validación para asegurarse de que el campo 'nombre' no esté vacío
    $request->validate([
        'nombre' => 'required|string|max:255',  // Valida que 'nombre' no esté vacío y sea una cadena
    ]);

    // Actualizamos el docente con el nuevo nombre
    $teacher->update($request->only('nombre'));

    // Redirigir de vuelta a la lista de docentes
    return redirect()->route('teachers.index')->with('success', 'Docente actualizado correctamente');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::find($id);

        if ($teacher && $teacher->delete()) {
            return redirect('teachers/');
        } else {
            return 'El docente con ID ' . $id . ' no se pudo borrar';
        }
    }
}

