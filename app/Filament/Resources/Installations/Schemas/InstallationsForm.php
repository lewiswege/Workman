<?php

namespace App\Filament\Resources\Installations\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InstallationsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Installation Details')
                    ->description('Basic information about the installation')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        TextInput::make('name')
                            ->label('Customer Name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('phone_number')
                            ->label('Phone Number')
                            ->required()
                            ->tel()
                            ->mask('9999999999')
                            ->placeholder('07xxxxxxx')
                            ->maxLength(10),

                        Select::make('area')
                            ->label('Service Area')
                            ->options(config('areas'))
                            ->searchable()
                            ->required()
                            ->native(false),

                        Select::make('package')
                            ->label('Package Type')
                            ->options(config('packages'))
                            ->searchable()
                            ->required()
                            ->native(false),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Section::make('Assignment & Scheduling')
                    ->description('Assign team and set installation schedule')
                    ->icon('heroicon-o-calendar')
                    ->schema([
                        Select::make('team_id')
                            ->relationship('team', 'identity')
                            ->label('Assigned Installer Team')
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->helperText('Select the team responsible for this installation'),

                        DatePicker::make('scheduled_on')
                            ->label('Scheduled Date')
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->helperText('Select the planned installation date'),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Section::make('Status Information')
                    ->description('Track installation progress and task status')
                    ->icon('heroicon-o-flag')
                    ->schema([
                        TextInput::make('task_status')
                            ->label('Task Status')
                            ->default('Available')
                            ->disabled()
                            ->dehydrated(true)
                            ->helperText('System managed - updates automatically'),

                        Select::make('status')
                            ->label('Installation Status')
                            ->options([
                                'scheduled' => 'Scheduled',
                                'pending' => 'Pending',
                                'completed' => 'Completed',
                                'failed' => 'Failed',
                                'rescheduled' => 'Rescheduled'
                            ])
                            ->default('scheduled')
                            ->required()
                            ->native(false),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }
}
