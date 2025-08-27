<?php

namespace App\Filament\Resources\CreateUsers\Pages;

use App\Filament\Resources\CreateUsers\CreateUserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCreateUser extends EditRecord
{
    protected static string $resource = CreateUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
