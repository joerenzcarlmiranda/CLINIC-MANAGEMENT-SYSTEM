<?php

namespace App\Models;

use App\Concerns\HasPrefixedId;
use App\Enums\GenderEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory, HasPrefixedId, HasUuids;

    protected string $idPrefix = 'PT';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function consultations()
    {
        return $this->hasManyThrough(
            Consultation::class,
            Appointment::class,
        );
    }

    public function prescriptions()
    {
        return $this->hasManyThrough(
            Prescription::class,
            Consultation::class,
            'id',           // consultations.id
            'consultation_id',
            'id',           // patients.id
            'id',
        )->whereIn(
            'consultations.id',
            $this->consultations()->select('consultations.id')
        );
    }

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->first_name} {$this->last_name}",
        );
    }

    public function casts(): array
    {
        return [
            'id' => 'string',
            'gender' => GenderEnum::class,
        ];
    }
}
