<?php

namespace App\Http\Controllers;

use App\Models\CareerGroup;
use Illuminate\Http\Request;

class CareerGroupController extends Controller
{
    public function index()
    {
        $careerGroups = CareerGroup::all();
        // Carga la vista directamente en resources/views/careergroups.blade.php
        return view('careergroups', compact('careerGroups'));
    }

    public function create()
    {
        // Cambia la vista create también para que esté en resources/views/careerGroups/create.blade.php?
        // O en resources/views/create.blade.php? Si quieres que create y edit estén igual, hay que saber
        return view('careerGroups.create'); // Si no existe esta vista, la debes crear o cambiar la ruta aquí
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:career_groups',
        ]);

        CareerGroup::create($request->all());

        // Ruta corregida para que coincida con el nombre usado en routes
        return redirect()->route('careergroups.index')->with('success', 'Grupo de carrera registrado exitosamente');
    }

    public function edit(CareerGroup $careergroup)
    {
        return view('edit_careergroups', compact('careergroup'));
    }

    public function update(Request $request, CareerGroup $careergroup)
    {
        $request->validate([
            'nombre' => 'required|unique:career_groups,nombre,' . $careergroup->id,
            // otras reglas...
        ]);

        $careergroup->update($request->all());

        return redirect()->route('careergroups.index')->with('success', 'Actualizado correctamente');
    }


    public function destroy(CareerGroup $careergroup)
    {
        // Quitar relaciones en la tabla pivot
        $careergroup->teachers()->detach();

        // Eliminar el grupo/carrera
        $careergroup->delete();

        return redirect()->route('careergroups.index')->with('success', 'Grupo de carrera eliminado exitosamente');
    }

}
