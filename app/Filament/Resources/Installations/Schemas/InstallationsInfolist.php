<?php

namespace App\Filament\Resources\Installations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InstallationsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('task_status'),
                TextEntry::make('name'),
                TextEntry::make('area')
                    ->placeholder('-'),
                TextEntry::make('package')
                    ->placeholder('-'),
                TextEntry::make('team.identity')
                    ->label('Installer')
                    ->placeholder('-'),
                TextEntry::make('status'),
                TextEntry::make('scheduled_on')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
