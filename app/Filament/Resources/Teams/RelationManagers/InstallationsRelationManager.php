<?php

namespace App\Filament\Resources\Teams\RelationManagers;

use App\Filament\Resources\Installations\Schemas\InstallationsForm;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InstallationsRelationManager extends RelationManager
{
    protected static string $relationship = 'installations';

    protected static ?string $title = 'Tasks';

    public function form(Schema $schema): Schema
    {
        return InstallationsForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('task_status')
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
                        'Available' => 'violet',
                        default => 'violet',
                    })
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('area')
                    ->searchable(),
                TextColumn::make('package')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'scheduled' => 'info',
                        'pending' => 'warning',
                        'failed' => 'danger',
                        'rescheduled' => 'danger',
                    })
                    ->searchable(),
                TextColumn::make('scheduled_on')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
