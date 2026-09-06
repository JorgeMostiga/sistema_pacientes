<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\TreatmentSheet;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function show(TreatmentSheet $sheet)
    {
        $sheet->load(['patient', 'sessions' => function($q) {
            $q->orderBy('year', 'desc')->orderBy('month', 'desc')->orderBy('day', 'desc');
        }]);
        return view('doctor.treatments.show', compact('sheet'));
    }

    public function updateDiagnosis(Request $request, TreatmentSheet $sheet)
    {
        $request->validate(['diagnosis' => 'required|string']);
        
        $sheet->update([
            'diagnosis' => $request->diagnosis
        ]);

        return back()->with('success', 'Diagnóstico actualizado correctamente.');
    }
}
