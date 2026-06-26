<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum AppointmentStatusEnum: string implements HasColor, HasDescription, HasIcon, HasLabel
{
    const DEFAULT = self::Pending;

    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case Completed = 'completed';
    case Cancelled = 'cancelled';
    case NoShow = 'no_show';

    public function getLabel(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Confirmed => 'Confirmed',
            self::Completed => 'Completed',
            self::Cancelled => 'Cancelled',
            self::NoShow => 'No Show',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::Pending => 'Awaiting confirmation or review.',
            self::Confirmed => 'Appointment is confirmed and scheduled.',
            self::Completed => 'The visit has been successfully completed.',
            self::Cancelled => 'The appointment was cancelled.',
            self::NoShow => 'The patient did not arrive for the appointment.',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Pending => 'heroicon-o-clock',
            self::Confirmed => 'heroicon-o-check-circle',
            self::Completed => 'heroicon-o-hand-thumb-up',
            self::Cancelled => 'heroicon-o-x-circle',
            self::NoShow => 'heroicon-o-exclamation-triangle',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Confirmed => 'info',
            self::Completed => 'success',
            self::Cancelled => 'danger',
            self::NoShow => 'gray',
        };
    }
}