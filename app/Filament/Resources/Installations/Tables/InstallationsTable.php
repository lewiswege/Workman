<?php

namespace App\Filament\Resources\Installations\Tables;

use App\Filament\Resources\Installations\InstallationsResource;
use App\Models\Installations;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class InstallationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
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
                TextColumn::make('team.identity')
                    ->label('Installer')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'scheduled' => 'info',
                        'pending' => 'warning',
                        'completed' => 'success',
                        'failed' => 'danger',
                        'rescheduled' => 'danger',
                    })
                    ->searchable(),
                TextColumn::make('scheduled_on')
                    ->date()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'scheduled' => 'Scheduled',
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'failed' => 'Failed',
                        'rescheduled' => 'Rescheduled',
                    ])
                    ->default('scheduled,pending,failed,rescheduled')
                    ->multiple(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),

                Action::make('openTask')
                    ->requiresConfirmation()
                    ->modalHeading('Open Task?')
                    ->modalDescription('This will run a timer for the current task')
                    ->modalSubmitActionLabel('Yes, Open')
                    ->label('Open Task')
                    ->icon('heroicon-o-play')
                    ->color('success')
                    ->visible(fn ($record) => $record->task_status === 'Locked' || $record->task_status === 'Available')
                    ->action(function ($record) {
                        // Set all installations to Locked
                        Installations::query()->update(['task_status' => 'Locked']);

                        // Set this specific installation to Active
                        $record->update(['task_status' => 'Active']);

                        return redirect(InstallationsResource::getUrl('view', ['record' => $record]));
                    }),

                DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalHeading('Delete Installation?')
                    ->modalDescription('This action cannot be undone')
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
