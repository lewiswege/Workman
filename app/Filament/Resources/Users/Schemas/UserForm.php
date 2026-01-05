<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Information')
                    ->description('Basic user account details')
                    ->icon('heroicon-o-user')
                    ->schema([
                        TextInput::make('name')
                            ->label('Full Name')
                            ->required()
                            ->maxLength(255)
                            ->helperText('User\'s full name'),

                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Unique email address for login'),

                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->required()
                            ->minLength(8)
                            ->dehydrated(fn ($state) => filled($state))
                            ->helperText('Minimum 8 characters (leave blank to keep current)'),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Section::make('Team Assignment')
                    ->description('Assign user to an installation team')
                    ->icon('heroicon-o-user-group')
                    ->schema([
                        Select::make('team_id')
                            ->relationship('team', 'identity')
                            ->label('Assigned Team')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->native(false)
                            ->helperText('Select the team this user belongs to')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }
}
