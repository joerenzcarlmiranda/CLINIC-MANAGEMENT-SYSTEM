<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Icons\Heroicon;

enum RoleEnum: string implements HasColor, HasDescription, HasIcon, HasLabel
{
    case ADMIN = 'Admin';
    case DOCTOR = 'Doctor';
    case RECEPTIONIST = 'Receptionist';
    case PATIENT = 'Patient';

    public function getLabel(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrator',
            self::DOCTOR => 'Doctor',
            self::RECEPTIONIST => 'Receptionist',
            self::PATIENT => 'Patient',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::ADMIN => 'Has full access to the system.',
            self::DOCTOR => 'Can manage patients and appointments.',
            self::RECEPTIONIST => 'Can register patients and manage appointments.',
            self::PATIENT => 'Can view their own medical records and schedule appointments.',
        };
    }

    public function getIcon(): string
    {
        return 'heroicon-o-'.(match ($this) {
            self::ADMIN => Heroicon::ShieldCheck,
            self::DOCTOR => Heroicon::AcademicCap,
            self::RECEPTIONIST => Heroicon::CalendarDays,
            self::PATIENT => Heroicon::User,
        })->value;
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::ADMIN => 'danger',
            self::DOCTOR => 'success',
            self::RECEPTIONIST => 'secondary',
            self::PATIENT => 'primary',
        };
    }
}
