<?php

namespace App\Filament\Resources\Installations\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InstallationsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('task_status')
                    ->default('Available')
                    ->disabled()
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('area'),
                TextInput::make('package'),
                Select::make('team_id')
                    ->relationship('team', 'identity')
                    ->label('Installer')
                    ->searchable()
                    ->preload(),
                TextInput::make('status')
                    ->required(),
                DatePicker::make('scheduled_on'),
            ]);
    }
}
