<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\TreatmentSheet;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function download(TreatmentSheet $sheet)
    {
        $sheet->load('patient', 'sessions');
        
        $pdf = Pdf::loadView('doctor.treatments.pdf', compact('sheet'))
                  ->setPaper('a4', 'landscape');
                  
        return $pdf->stream('ficha_tratamiento_' . $sheet->patient->names . '.pdf');
    }
}
