<?php

namespace App\Filament\Resources\ExtensionInvolvements\Pages;

use App\Filament\Resources\ExtensionInvolvements\ExtensionInvolvementResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListExtensionInvolvements extends ListRecords
{
    protected static string $resource = ExtensionInvolvementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
