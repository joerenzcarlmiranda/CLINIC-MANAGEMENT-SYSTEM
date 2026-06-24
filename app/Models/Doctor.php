<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Enums\GenderEnum;
class Doctor extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function casts(): array
    {
        return [
            'id' => 'string',
            'gender' => GenderEnum::class,
        ];
    }
}
