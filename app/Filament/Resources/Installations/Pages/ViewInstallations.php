<?php

namespace App\Filament\Resources\Installations\Pages;

use App\Filament\Resources\Installations\InstallationsResource;
use App\Models\Installations;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewInstallations extends ViewRecord
{
    protected static string $resource = InstallationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),

            Action::make('completeInstallation')
                ->label('Complete')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Complete Installation')
                ->modalDescription('This will mark the installation as complete.')
                ->modalSubmitActionLabel('Complete')
                ->visible(fn ($record) => $record->task_status === 'Active' && $record->status !== 'completed')
                ->action(function ($record) {
                    // Update the record to completed
                    $record->update([
                        'status' => 'completed',
                        'completed_at' => now(),
                        'task_status' => 'Available'
                    ]);

                    // Set all remaining installations to Available
                    Installations::query()->update(['task_status' => 'Available']);

                    // Show success notification
                    Notification::make()
                        ->success()
                        ->title('Installation Completed')
                        ->body('The installation has been marked as completed. All tasks are now available.')
                        ->send();

                    // Redirect to the list page
                    return redirect(InstallationsResource::getUrl('index'));
                }),
        ];
    }
}
