<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        logger('Entrando al método index() de SubjectController');

        $subjects = Subject::all();

        // Prueba si llega aquí correctamente
        // dd($subjects);

        return view('subjects', compact('subjects'));
    }

    public function create()
    {
        logger('Entrando al método create() de SubjectController');

        // Vista sin carpeta: subjects_create.blade.php
        return view('subjects_create');
    }

    public function store(Request $request)
    {
        logger('Entrando al método store() de SubjectController');
        logger($request->all());

        $request->validate([
            'nombre' => 'required|string|max:50|unique:subjects',
        ]);

        Subject::create($request->all());

        return redirect()->route('subjects.index')->with('success', 'Materia registrada exitosamente');
    }

    public function edit(Subject $subject)
    {
        logger('Entrando al método edit() de SubjectController');
        logger(['subject' => $subject]);

        // Vista sin carpeta: subjects_edit.blade.php
        return view('edit_subject', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        logger('Entrando al método update() de SubjectController');

        $request->validate([
            'nombre' => 'required|string|max:50|unique:subjects,nombre,' . $subject->id,
        ]);

        $subject->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Materia actualizada correctamente');
    }

    public function destroy(Subject $subject)
    {
        logger('Entrando al método destroy() de SubjectController');

        $subject->delete();

        return redirect()->route('subjects.index')->with('success', 'Materia eliminada exitosamente');
    }
}