<?php

namespace App\Concerns;

use Illuminate\Support\Str;

/**
 * Generates a human-readable display_id (e.g. PT-0001, DOC-0042, APTM-0123)
 * on the `creating` event of any Eloquent model.
 *
 * Usage: add `use HasPrefixedId;` to your model and define:
 *
 *   protected string $idPrefix = 'PT';
 *
 * The generated value is stored in the `display_id` column and is:
 * - unique per model table
 * - zero-padded to 4 digits (supports up to 9999 before expanding automatically)
 * - read-only after creation (never regenerated on updates)
 */
trait HasPrefixedId
{
    public static function bootHasPrefixedId(): void
    {
        static::creating(function (self $model): void {
            if (filled($model->display_id)) {
                return;
            }

            $model->display_id = static::generateDisplayId();
        });
    }

    public static function generateDisplayId(): string
    {
        $prefix = (new static)->getIdPrefix();

        $latest = static::query()
            ->whereNotNull('display_id')
            ->orderByDesc('created_at')
            ->value('display_id');

        $next = 1;

        if ($latest) {
            $parts = explode('-', $latest, 2);
            $next = ((int) ($parts[1] ?? 0)) + 1;
        }

        return $prefix.'-'.str_pad($next, 4, '0', STR_PAD_LEFT);
    }

    public function getIdPrefix(): string
    {
        return property_exists($this, 'idPrefix')
            ? $this->idPrefix
            : Str::upper(Str::substr(class_basename($this), 0, 3));
    }
}
