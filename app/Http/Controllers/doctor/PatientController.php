<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
  /*   public function index()
    {
        $patients = Patient::latest()->paginate(10);
        return view('doctor.patients.index', compact('patients'));
    } */

    public function index()
    {
        // Cargamos los pacientes junto con su última ficha activa
        $patients = Patient::with('treatmentSheets')->latest()->paginate(10);
        return view('doctor.patients.index', compact('patients'));
    }


    public function create()
    {
        return view('doctor.patients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'paternal_surname' => 'required|string|max:100',
            'maternal_surname' => 'nullable|string|max:100',
            'names' => 'required|string|max:100',
            'dni' => 'required|string|size:8|unique:patients',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
        ]);

        Patient::create($validated);
        return redirect()->route('doctor.patients.index')->with('success', 'Paciente registrado correctamente.');
    }

    public function edit(Patient $patient)
    {
        return view('doctor.patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'paternal_surname' => 'required|string|max:100',
            'maternal_surname' => 'nullable|string|max:100',
            'names' => 'required|string|max:100',
            'dni' => 'required|string|size:8|unique:patients,dni,' . $patient->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
        ]);

        $patient->update($validated);
        return redirect()->route('doctor.patients.index')->with('success', 'Datos del paciente actualizados.');
    }
}
