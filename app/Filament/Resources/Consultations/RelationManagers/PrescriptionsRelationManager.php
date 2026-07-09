<?php

namespace App\Filament\Resources\Consultations\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PrescriptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'prescriptions';

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
            Grid::make(2)
                ->schema([
                    TextInput::make('medicine')->required(),
                    TextInput::make('dosage')->required()->placeholder('e.g. 500mg'),
                    TextInput::make('frequency')->required()->placeholder('e.g. Twice daily'),
                    TextInput::make('duration')->required()->placeholder('e.g. 7 days'),
                    Textarea::make('instructions')->placeholder('e.g. Take after meals')->columnSpanFull(),
                ]),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('display_id')
                    ->label('Prescription ID')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('medicine'),
                TextColumn::make('dosage'),
                TextColumn::make('frequency'),
                TextColumn::make('duration'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                CreateAction::make(),
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
