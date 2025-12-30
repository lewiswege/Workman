<?php

namespace App\Filament\Resources\Tenants\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextInputColumn;
use app\Models\User;
use Filament\Notifications\Notification;
use PhpParser\Node\Stmt\Label;

use function Laravel\Prompts\select;

class TenantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->required(),
                TextInput::make('phone_number')
                    ->required()
                    ->tel(),
                TextInput::make('alternative_number')
                    ->label('Alternative phone'),
                TextInput::make('house_number')
                    ->required(),
                DatePicker::make('moved_in_at'),

                Select::make('account_type')
                    ->options([
                        'personal' => 'Personal',
                        'business' => 'Business'
                    ])
                    ->reactive(),

                TextInput::make('company_name')
                        ->visible(fn($get) => $get('account_type') === 'business'),

                Select::make('status')
                        ->options([
                            'draft' => 'Draft',
                            'reviewing' => 'Reviewing',
                            'published' => 'Published'

                        ])
                        ->native(false),

                Select::make('author_id')
                        ->label('Author')
                        ->options(User::query()->pluck('name', 'id'))
                        ->searchable(),


            ]);
    }
}
