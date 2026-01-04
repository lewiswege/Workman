<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Profile')
                    ->icon('heroicon-o-user-circle')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Group::make([
                                    TextEntry::make('name')
                                        ->label('Full Name')
                                        ->weight(FontWeight::Bold)
                                        ->icon('heroicon-o-user')
                                        ->color('primary'),

                                    TextEntry::make('email')
                                        ->label('Email Address')
                                        ->icon('heroicon-o-envelope')
                                        ->copyable()
                                        ->copyMessage('Email copied!')
                                        ->color('info'),
                                ]),

                                Group::make([
                                    TextEntry::make('team.identity')
                                        ->label('Assigned Team')
                                        ->icon('heroicon-o-user-group')
                                        ->placeholder('No team assigned')
                                        ->color('success'),

                                    TextEntry::make('email_verified_at')
                                        ->label('Email Verified')
                                        ->icon(fn ($state) => $state ? 'heroicon-o-check-badge' : 'heroicon-o-x-circle')
                                        ->dateTime('d M, Y H:i')
                                        ->placeholder('Not verified')
                                        ->color(fn ($state) => $state ? 'success' : 'danger'),
                                ]),
                            ]),
                    ])
                    ->collapsible(),

                Section::make('Account Information')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Account Created')
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
