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
                Select::make('area')
                    ->options(config('areas'))
                    ->searchable()
                    ->required(),
                Select::make('package')
                    ->options(config('packages'))
                    ->searchable()
                    ->required(),
                Select::make('team_id')
                    ->relationship('team', 'identity')
                    ->label('Installer')
                    ->searchable()
                    ->preload(),
                Select::make('status')
                    ->options([
                        'scheduled' => 'Scheduled',
                        'pending' => 'Pending',
                        'failed' => 'Failed',
                        'rescheduled' => 'Rescheduled'
                    ])
                    ->default('scheduled')
                    ->required(),
                DatePicker::make('scheduled_on'),
            ]);
    }
}
