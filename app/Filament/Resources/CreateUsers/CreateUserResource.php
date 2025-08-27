<?php

namespace App\Filament\Resources\CreateUsers;

use App\Filament\Resources\CreateUsers\Pages\CreateCreateUser;
use App\Filament\Resources\CreateUsers\Pages\EditCreateUser;
use App\Filament\Resources\CreateUsers\Pages\ListCreateUsers;
use App\Filament\Resources\CreateUsers\Schemas\CreateUserForm;
use App\Filament\Resources\CreateUsers\Tables\CreateUsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class CreateUserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Users';
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-user-plus';

    protected static string | UnitEnum | null $navigationGroup = 'User Management';


    public static function form(Schema $schema): Schema
    {
        return CreateUserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CreateUsersTable::configure($table);
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
            'index' => ListCreateUsers::route('/'),
            'create' => CreateCreateUser::route('/create'),
            'edit' => EditCreateUser::route('/{record}/edit'),
        ];
    }
}
