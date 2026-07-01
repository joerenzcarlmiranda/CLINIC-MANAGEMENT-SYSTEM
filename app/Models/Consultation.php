<?php

namespace App\Models;

use App\Concerns\HasPrefixedId;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory, HasPrefixedId, HasUuids;

    protected string $idPrefix = 'CONS';

    protected $guarded = ['id'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function casts(): array
    {
        return [
            'id' => 'string',
            'consultation_date' => 'date',
        ];
    }
}
