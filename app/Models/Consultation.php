<?php

namespace App\Models;

use App\Concerns\HasPrefixedId;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Consultation extends Model
{
    use HasFactory, HasPrefixedId, HasUuids;

    protected string $idPrefix = 'CONS';

    protected $guarded = ['id'];

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class);
    }

    /**
     * Shortcut accessors — avoids deep chaining in views/tables.
     * These read through the appointment relation, no duplicate data stored.
     */
    public function getPatientAttribute(): ?Patient
    {
        return $this->appointment?->patient;
    }

    public function getDoctorAttribute(): ?Doctor
    {
        return $this->appointment?->doctor;
    }

    public function casts(): array
    {
        return [
            'id'                => 'string',
            'consultation_date' => 'date',
        ];
    }
}
