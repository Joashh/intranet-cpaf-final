<?php

namespace App\Filament\Resources\Extensions;

use App\Filament\Resources\Extensions\Pages\CreateExtension;
use App\Filament\Resources\Extensions\Pages\EditExtension;
use App\Filament\Resources\Extensions\Pages\ListExtensions;
use App\Filament\Resources\Extensions\Schemas\ExtensionForm;
use App\Filament\Resources\Extensions\Tables\ExtensionsTable;
use App\Models\ExtensionPrime;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
class ExtensionResource extends Resource
{
    protected static ?string $model = ExtensionPrime::class;

    protected static ?string $recordTitleAttribute = 'title_of_extension_program';
    protected static ?string $navigationLabel = 'Extension';
    protected static ?string $modelLabel = 'Extension';
    protected static ?string $pluralModelLabel = 'Extensions';
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static string | UnitEnum | null $navigationGroup = 'Programs';

    public static function form(Schema $schema): Schema
    {
        return ExtensionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExtensionsTable::configure($table);
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
            'index' => ListExtensions::route('/'),
            'create' => CreateExtension::route('/create'),
            'edit' => EditExtension::route('/{record}/edit'),
        ];
    }
}
