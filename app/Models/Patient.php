<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    protected $fillable = ['user_id', 'paternal_surname', 'maternal_surname', 'names', 'dni', 'phone', 'address', 'birth_date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function treatmentSheets(): HasMany
    {
        return $this->hasMany(TreatmentSheet::class);
    }
}
