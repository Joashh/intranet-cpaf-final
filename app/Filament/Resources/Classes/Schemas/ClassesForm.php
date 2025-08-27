<?php

namespace App\Filament\Resources\Classes\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
class ClassesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name'),
            ]);
    }
}
