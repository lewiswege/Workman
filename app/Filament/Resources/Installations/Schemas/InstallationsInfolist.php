<?php

namespace App\Filament\Resources\Installations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;

class InstallationsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Installation Overview')
                    ->description('If the router is swapped make sure to record its mac and serial numbers')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Group::make([
                                    TextEntry::make('name')
                                        ->label('Customer Name')
                                        ->weight(FontWeight::Bold)
                                        ->icon('heroicon-o-user'),

                                    TextEntry::make('phone_number')
                                        ->label('Phone Number')
                                        ->icon('heroicon-o-phone')
                                        ->placeholder('Not provided')
                                        ->copyable(),

                                    TextEntry::make('area')
                                        ->label('Service Area')
                                        ->icon('heroicon-o-map-pin')
                                        ->placeholder('Not specified')
                                        ->color('primary'),

                                    TextEntry::make('package')
                                        ->label('Package Type')
                                        ->icon('heroicon-o-cube')
                                        ->placeholder('Not specified')
                                        ->color('info'),
                                ]),

                                Group::make([
                                    TextEntry::make('team.identity')
                                        ->label('Assigned Team')
                                        ->icon('heroicon-o-user-group')
                                        ->placeholder('Not assigned')
                                        ->color('success'),


                                    TextEntry::make('scheduled_on')
                                        ->label('Scheduled Date')
                                        ->icon('heroicon-o-calendar')
                                        ->date('d M, Y')
                                        ->placeholder('Not scheduled')
                                        ->color('warning'),
                                ]),
                            ]),
                    ])
                    ->collapsible(),

                Section::make('Status & Progress')
                    ->icon('heroicon-o-flag')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('task_status')
                                    ->label('Task Status')
                                    ->badge()
                                    ->icon(fn (string $state): string => match($state) {
                                        'Active' => 'heroicon-o-play',
                                        'Locked' => 'heroicon-o-lock-closed',
                                        'Available' => 'heroicon-o-lock-open',
                                        default => 'heroicon-o-lock-open',
                                    })
                                    ->color(fn (string $state): string => match($state) {
                                        'Active' => 'success',
                                        'Locked' => 'warning',
                                        'Available' => 'info',
                                        default => 'gray',
                                    }),

                                TextEntry::make('status')
                                    ->label('Installation Status')
                                    ->badge()
                                    ->icon(fn (string $state): string => match($state) {
                                        'completed' => 'heroicon-o-check-circle',
                                        'failed' => 'heroicon-o-x-circle',
                                        'pending' => 'heroicon-o-clock',
                                        'scheduled' => 'heroicon-o-calendar',
                                        'rescheduled' => 'heroicon-o-arrow-path',
                                        default => 'heroicon-o-question-mark-circle',
                                    })
                                    ->color(fn (string $state): string => match($state) {
                                        'scheduled' => 'info',
                                        'pending' => 'warning',
                                        'completed' => 'success',
                                        'failed' => 'danger',
                                        'rescheduled' => 'danger',
                                        default => 'gray',
                                    }),

                                TextEntry::make('completed_at')
                                    ->label('Completed At')
                                    ->icon('heroicon-o-check-badge')
                                    ->dateTime('d M, Y H:i')
                                    ->placeholder('Not completed')
                                    ->color('success'),
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
