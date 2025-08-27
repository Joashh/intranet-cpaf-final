<?php

namespace App\Filament\Resources\MOUandMOAS;

use App\Filament\Resources\MOUandMOAS\Pages\CreateMOUandMOA;
use App\Filament\Resources\MOUandMOAS\Pages\EditMOUandMOA;
use App\Filament\Resources\MOUandMOAS\Pages\ListMOUandMOAS;
use App\Filament\Resources\MOUandMOAS\Schemas\MOUandMOAForm;
use App\Filament\Resources\MOUandMOAS\Tables\MOUandMOASTable;
use App\Models\Document;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MOUandMOAResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentArrowDown;

    protected static ?string $recordTitleAttribute = 'extension_title';
    protected static ?string $navigationLabel = 'MOU and MOA';
    protected static ?string $modelLabel = 'MOU and MOA';

    protected static string | UnitEnum | null $navigationGroup = 'Documents';

    public static function form(Schema $schema): Schema
    {
        return MOUandMOAForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MOUandMOASTable::configure($table);
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
            'index' => ListMOUandMOAS::route('/'),
            'create' => CreateMOUandMOA::route('/create'),
            'edit' => EditMOUandMOA::route('/{record}/edit'),
        ];
    }
}
