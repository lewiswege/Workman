<?php

namespace App\Filament\Resources\Teams\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;

class TeamInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Team Details')
                    ->icon('heroicon-o-user-group')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Group::make([
                                    TextEntry::make('identity')
                                        ->label('License Plate / Vehicle ID')
                                        ->weight(FontWeight::Bold)
                                        ->icon('heroicon-o-truck')
                                        ->color('primary'),

                                    TextEntry::make('type')
                                        ->label('Team Type')
                                        ->badge()
                                        ->icon(fn (string $state): string => match($state) {
                                            'MT' => 'heroicon-o-rocket-launch',
                                            'VH' => 'heroicon-o-truck',
                                            default => 'heroicon-o-question-mark-circle',
                                        })
                                        ->color(fn (string $state): string => match($state) {
                                            'MT' => 'warning',
                                            'VH' => 'success',
                                            default => 'gray',
                                        })
                                        ->formatStateUsing(fn (string $state): string => match($state) {
                                            'MT' => 'Motorcycle Team',
                                            'VH' => 'Vehicle Team',
                                            default => $state,
                                        }),
                                ]),

                                Group::make([
                                    TextEntry::make('leader')
                                        ->label('Team Leader')
                                        ->icon('heroicon-o-user')
                                        ->color('success'),

                                    TextEntry::make('users.name')
                                        ->label('Team Members')
                                        ->color('info')
                                        ->bulleted()
                                        ->placeholder('No members'),
                                ]),
                            ]),
                    ])
                    ->collapsible(),

                Section::make('Record Information')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Created On')
                                    ->icon('heroicon-o-plus-circle')
                                    ->dateTime('d M, Y H:i')
                                    ->placeholder('Unknown'),

                                TextEntry::make('updated_at')
                                    ->label('Last Updated')
                                    ->icon('heroicon-o-arrow-path')
                                    ->dateTime('d M, Y H:i')
                                    ->placeholder('Never')
                                    ->since(),
                            ]),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }
}
