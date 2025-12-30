<?php

namespace App\Filament\Resources\Installations\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InstallationsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('task_status')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('area'),
                TextInput::make('package'),
                TextInput::make('installer'),
                TextInput::make('status')
                    ->required(),
                DatePicker::make('scheduled_on'),
            ]);
    }
}
