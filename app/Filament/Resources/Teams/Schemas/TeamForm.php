<?php

namespace App\Filament\Resources\Teams\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TeamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->options([
                        'MT' => 'MT',
                        'VH' => 'VH',
                    ])
                    ->required(),
                TextInput::make('identity')
                    ->label('License Plate')
                    ->required()
                    ->extraInputAttributes(['style' => 'text-transform: uppercase'])
                    ->dehydrateStateUsing(fn ($state) => strtoupper($state)),
                TextInput::make('leader')
                    ->label('Team leader')
                    ->required()
            ]);
    }
}
