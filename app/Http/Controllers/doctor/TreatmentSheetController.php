<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\TreatmentSheet;
use Illuminate\Http\Request;

class TreatmentSheetController extends Controller
{
    public function create(Patient $patient)
    {
        return view('doctor.treatments.create', compact('patient'));
    }

    public function store(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'diagnosis' => 'required|string',
            'payment_method' => 'required|in:yape,plin,efectivo,tarjeta',
        ]);

        $sheet = $patient->treatmentSheets()->create([
            'therapist_id' => auth()->id(),
            'diagnosis' => $validated['diagnosis'],
            'payment_method' => $validated['payment_method'],
        ]);

        return redirect()->route('doctor.patients.index')->with('success', 'Ficha creada con éxito.');
    }
}
