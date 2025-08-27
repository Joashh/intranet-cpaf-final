<?php

namespace App\Filament\Resources\CreateUsers\Pages;

use App\Filament\Resources\CreateUsers\CreateUserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCreateUsers extends ListRecords
{
    protected static string $resource = CreateUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
