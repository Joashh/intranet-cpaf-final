<?php

namespace App\Filament\Resources\Publications;

use App\Filament\Resources\Publications\Pages\CreatePublication;
use App\Filament\Resources\Publications\Pages\EditPublication;
use App\Filament\Resources\Publications\Pages\ListPublications;
use App\Filament\Resources\Publications\Schemas\PublicationForm;
use App\Filament\Resources\Publications\Tables\PublicationsTable;
use App\Models\Publication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
class PublicationResource extends Resource
{
    protected static ?string $model = Publication::class;


    protected static ?string $recordTitleAttribute = 'title_of_publication';
    protected static ?string $navigationLabel = 'Publication';
    protected static ?string $modelLabel = 'Publication';
    protected static ?string $pluralModelLabel = 'Publication';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-bookmark-square';
    protected static string|UnitEnum|null $navigationGroup = 'Accomplishments';

    public static function getRecordTitle(?object $record): string
    {
        return $record ? \Illuminate\Support\Str::limit($record->title_of_publication, 20) : 'Record';
    }

    public static function form(Schema $schema): Schema
    {
        return PublicationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PublicationsTable::configure($table);
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
            'index' => ListPublications::route('/'),
            'create' => CreatePublication::route('/create'),
            'edit' => EditPublication::route('/{record}/edit'),
        ];
    }
}
