<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Icons\Heroicon;

enum RoleEnum: string implements HasLabel, HasColor, HasIcon, HasDescription
{
    case ADMIN = 'Admin';
    case DOCTOR = 'Doctor';
    case RECEPTIONIST = 'Receptionist';

    public function getLabel(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrator',
            self::DOCTOR => 'Doctor',
            self::RECEPTIONIST => 'Receptionist',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::ADMIN => 'Has full access to the system.',
            self::DOCTOR => 'Can manage patients and appointments.',
            self::RECEPTIONIST => 'Can register patients and manage appointments.',
        };
    }

    public function getIcon(): string
    {
        return 'heroicon-o-' . (match ($this) {
            self::ADMIN => Heroicon::ShieldCheck,
            self::DOCTOR => Heroicon::AcademicCap,
            self::RECEPTIONIST => Heroicon::CalendarDays,
        })->value;
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::ADMIN => 'danger',
            self::DOCTOR => 'success',
            self::RECEPTIONIST => 'primary',
        };
    }
}
