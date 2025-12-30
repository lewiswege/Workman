<?php

namespace App\Filament\Resources\Installations\Pages;

use App\Filament\Resources\Installations\InstallationsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

use function Symfony\Component\Clock\now;

class EditInstallations extends EditRecord
{
    protected static string $resource = InstallationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    #customising the redirect
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
