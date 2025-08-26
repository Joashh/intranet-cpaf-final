<?php

namespace App\Filament\Resources\AwardsRecognitions\Pages;

use App\Filament\Resources\AwardsRecognitions\AwardsRecognitionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAwardsRecognition extends EditRecord
{
    protected static string $resource = AwardsRecognitionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
