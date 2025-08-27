<?php

namespace App\Filament\Resources\ExtensionInvolvements\Pages;

use App\Filament\Resources\ExtensionInvolvements\ExtensionInvolvementResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditExtensionInvolvement extends EditRecord
{
    protected static string $resource = ExtensionInvolvementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    public function getTitle(): string
{
    
    return "Edit Extension Involvement";
}




}
