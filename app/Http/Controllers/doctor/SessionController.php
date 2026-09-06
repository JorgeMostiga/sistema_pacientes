<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\TreatmentSheet;
use App\Models\TreatmentSession;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SessionController extends Controller
{
    public function store(Request $request, TreatmentSheet $sheet)
    {
        $request->validate([
            'notes' => 'required|string',
            'payment_method' => 'required|in:yape,plin,efectivo,tarjeta',
        ]);

        $today = Carbon::now();
        
        TreatmentSession::create([
            'treatment_sheet_id' => $sheet->id,
            'year' => $today->year,
            'month' => $today->month,
            'day' => $today->day,
            'treatment_name' => 'General',
            'attended' => true,
            'notes' => $request->notes,
            'payment_method' => $request->payment_method,
        ]);

        return back()->with('success', 'Atención registrada correctamente.');
    }

    public function update(Request $request, TreatmentSession $session)
    {
        $request->validate(['notes' => 'required|string']);
        
        $session->update([
            'notes' => $request->notes
        ]);

        return back()->with('success', 'Atención actualizada correctamente.');
    }
}
