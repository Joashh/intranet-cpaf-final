<?php

namespace App\Filament\Resources\MOUandMOAS\Pages;

use App\Filament\Resources\MOUandMOAS\MOUandMOAResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMOUandMOA extends EditRecord
{
    protected static string $resource = MOUandMOAResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
