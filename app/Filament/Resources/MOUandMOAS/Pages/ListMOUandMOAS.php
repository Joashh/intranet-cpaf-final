<?php

namespace App\Filament\Resources\MOUandMOAS\Pages;

use App\Filament\Resources\MOUandMOAS\MOUandMOAResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMOUandMOAS extends ListRecords
{
    protected static string $resource = MOUandMOAResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
