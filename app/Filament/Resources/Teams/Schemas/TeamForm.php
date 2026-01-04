<?php

namespace App\Filament\Resources\Teams\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TeamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Team Information')
                    ->description('Basic details about the installation team')
                    ->icon('heroicon-o-user-group')
                    ->schema([
                        Select::make('type')
                            ->label('Team Type')
                            ->options([
                                'MT' => 'Motorcycle Team (MT)',
                                'VH' => 'Vehicle Team (VH)',
                            ])
                            ->required()
                            ->native(false)
                            ->helperText('Select the type of team vehicle'),

                        TextInput::make('identity')
                            ->label('License Plate / Vehicle ID')
                            ->required()
                            ->maxLength(20)
                            ->extraInputAttributes(['style' => 'text-transform: uppercase'])
                            ->dehydrateStateUsing(fn ($state) => strtoupper($state))
                            ->helperText('Vehicle license plate (auto-capitalized)'),

                        TextInput::make('leader')
                            ->label('Team Leader Name')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Name of the person leading this team'),
                    ])
                    ->columns(1)
                    ->collapsible(),
            ]);
    }
}
