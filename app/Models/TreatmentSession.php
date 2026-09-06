<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TreatmentSession extends Model
{
    protected $fillable = [
        'treatment_sheet_id', 
        'treatment_name', 
        'year', 
        'month', 
        'day', 
        'attended', 
        'notes', 
        'payment_details'
    ];

    public function treatmentSheet(): BelongsTo
    {
        return $this->belongsTo(TreatmentSheet::class);
    }
}
