<?php

namespace App\Filament\Resources\Installations;

use App\Filament\Resources\Installations\Pages\CreateInstallations;
use App\Filament\Resources\Installations\Pages\EditInstallations;
use App\Filament\Resources\Installations\Pages\ListInstallations;
use App\Filament\Resources\Installations\Pages\ViewInstallations;
use App\Filament\Resources\Installations\Schemas\InstallationsForm;
use App\Filament\Resources\Installations\Schemas\InstallationsInfolist;
use App\Filament\Resources\Installations\Tables\InstallationsTable;
use App\Models\Installations;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class InstallationsResource extends Resource
{
    protected static ?string $model = Installations::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedWifi;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 3;

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'phone_number', 'area', 'package', 'team.identity'];
    }

    public static function form(Schema $schema): Schema
    {
        return InstallationsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return InstallationsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InstallationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInstallations::route('/'),
            'create' => CreateInstallations::route('/create'),
            'view' => ViewInstallations::route('/{record}'),
            'edit' => EditInstallations::route('/{record}/edit'),
        ];
    }
}
