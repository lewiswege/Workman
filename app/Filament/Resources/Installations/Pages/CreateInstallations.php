<?php

namespace App\Filament\Resources\Installations\Pages;

use App\Filament\Resources\Installations\InstallationsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateInstallations extends CreateRecord
{
    protected static string $resource = InstallationsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
