<?php

namespace App\Models;

use App\Concerns\HasPrefixedId;
use App\Enums\AppointmentStatusEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory, HasPrefixedId, HasUuids;

    protected string $idPrefix = 'APTM';

    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function casts(): array
    {
        return [
            'id' => 'string',
            'appointment_date' => 'date',
            'appointment_time' => 'datetime',
            'status' => AppointmentStatusEnum::class,
        ];
    }
}
