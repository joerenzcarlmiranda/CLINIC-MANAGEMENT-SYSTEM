<?php

namespace App\Models;

use App\Concerns\HasPrefixedId;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prescription extends Model
{
    use HasFactory, HasPrefixedId, HasUuids;

    protected string $idPrefix = 'PRSC';

    protected $guarded = ['id'];

    public function consultation(): BelongsTo
    {
        return $this->belongsTo(Consultation::class);
    }

    /**
     * Shortcut: prescription → consultation → appointment → patient
     */
    public function patient(): BelongsTo
    {
        return $this->consultation->appointment->patient();
    }

    public function casts(): array
    {
        return [
            'id' => 'string',
        ];
    }
}
