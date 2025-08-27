<?php

namespace App\Filament\Resources\AwardsRecognitions;

use App\Filament\Resources\AwardsRecognitions\Pages\CreateAwardsRecognition;
use App\Filament\Resources\AwardsRecognitions\Pages\EditAwardsRecognition;
use App\Filament\Resources\AwardsRecognitions\Pages\ListAwardsRecognitions;
use App\Filament\Resources\AwardsRecognitions\Schemas\AwardsRecognitionForm;
use App\Filament\Resources\AwardsRecognitions\Tables\AwardsRecognitionsTable;
use App\Models\AwardsRecognitions;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AwardsRecognitionResource extends Resource
{
    protected static ?string $model = AwardsRecognitions::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-trophy';

    protected static string | UnitEnum | null $navigationGroup = 'Accomplishments';
    protected static ?string $recordTitleAttribute = 'award_title';

    public static function form(Schema $schema): Schema
    {
        return AwardsRecognitionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AwardsRecognitionsTable::configure($table);
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
            'index' => ListAwardsRecognitions::route('/'),
            'create' => CreateAwardsRecognition::route('/create'),
            'edit' => EditAwardsRecognition::route('/{record}/edit'),
        ];
    }
}
