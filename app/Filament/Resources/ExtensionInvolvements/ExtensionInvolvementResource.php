<?php

namespace App\Filament\Resources\ExtensionInvolvements;

use App\Filament\Resources\ExtensionInvolvements\Pages\CreateExtensionInvolvement;
use App\Filament\Resources\ExtensionInvolvements\Pages\EditExtensionInvolvement;
use App\Filament\Resources\ExtensionInvolvements\Pages\ListExtensionInvolvements;
use App\Filament\Resources\ExtensionInvolvements\Schemas\ExtensionInvolvementForm;
use App\Filament\Resources\ExtensionInvolvements\Tables\ExtensionInvolvementsTable;
use App\Models\Extension;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
class ExtensionInvolvementResource extends Resource
{
    protected static ?string $model = Extension::class;
    protected static ?string $recordTitleAttribute = 'event_title';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string|UnitEnum|null $navigationGroup = 'Accomplishments';
    protected static ?string $navigationLabel = 'Extension Involvements';
    protected static ?int $navigationSort = 4;
    protected static ?string $pluralLabel = 'Extension Involvements';

    
     public static function getRecordTitle(?object $record): string
    {
        return $record ? \Illuminate\Support\Str::limit($record->event_title, 40) : 'Record';
    }
    public static function form(Schema $schema): Schema
    {
        return ExtensionInvolvementForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExtensionInvolvementsTable::configure($table);
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
            'index' => ListExtensionInvolvements::route('/'),
            'create' => CreateExtensionInvolvement::route('/create'),
            'edit' => EditExtensionInvolvement::route('/{record}/edit'),
        ];
    }
}
