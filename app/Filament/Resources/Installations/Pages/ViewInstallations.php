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
                ->modalDescription('This will mark the installation as complete and remove it from the records.')
                ->modalSubmitActionLabel('Complete')
                ->visible(fn ($record) => $record->task_status === 'Active')
                ->action(function ($record) {
                    // Delete the completed task
                    $record->delete();

                    // Set all remaining installations to Available
                    Installations::query()->update(['task_status' => 'Available']);

                    // Show success notification
                    Notification::make()
                        ->success()
                        ->title('Installation Completed')
                        ->body('The installation has been completed and removed. All tasks are now available.')
                        ->send();

                    // Redirect to the list page
                    return redirect(InstallationsResource::getUrl('index'));
                }),
        ];
    }
}
