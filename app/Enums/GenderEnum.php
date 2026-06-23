<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Icons\Heroicon;
enum GenderEnum : string implements HasLabel, HasColor, HasIcon, HasDescription
{
    const DEFAULT = self::OTHER;
    case MALE = 'Male';
    case FEMALE ='Female';
    case OTHER = 'Other';

    public function getLabel(): string
    {
        return match ($this) {
            self::MALE => 'Male',
            self::FEMALE => 'Female',
            self::OTHER => 'Other',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::MALE => '',
            self::FEMALE => '',
            self::OTHER => '',
        };
    }

    public function getIcon(): string
    {
        return 'heroicon-o-' . (match ($this) {
            self::MALE => Heroicon::User,
            self::FEMALE => Heroicon::User,
            self::OTHER => Heroicon::User,
        })->value;
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::MALE => 'primary',
            self::FEMALE => 'danger',
            self::OTHER => 'secondary',
        };
    }


}
