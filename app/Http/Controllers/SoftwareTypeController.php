<?php

namespace App\Http\Controllers;

use App\Models\SoftwareType;
use Illuminate\Http\Request;

class SoftwareTypeController extends Controller
{
    public function index()
    {
        $softwareTypes = SoftwareType::all();
        return view('software_types', compact('softwareTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50|unique:software_types',
        ]);

        SoftwareType::create($request->only('nombre'));

        return redirect()->route('software-types.index')->with('success', 'Tipo de software registrado exitosamente');
    }

    public function edit(SoftwareType $softwareType)
    {
        return view('software_types_edit', compact('softwareType'));
    }
        
    
    public function update(Request $request, SoftwareType $software_type)
    {
        $request->validate([
            'nombre' => 'required|string|max:50|unique:software_types,nombre,' . $software_type->id,
        ]);

        $software_type->update($request->only('nombre'));

        return redirect()->route('software-types.index')->with('success', 'Tipo de software actualizado exitosamente');
    }

    public function destroy(SoftwareType $software_type)
    {
        $software_type->delete();

        return redirect()->route('software-types.index')->with('success', 'Tipo de software eliminado exitosamente');
    }
}