<?php

namespace App\Filament\Resources\AwardsRecognitions\Pages;

use App\Filament\Resources\AwardsRecognitions\AwardsRecognitionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAwardsRecognitions extends ListRecords
{
    protected static string $resource = AwardsRecognitionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\AwardsRecognitions\Widgets\StatsOverview::class,
        ];
    }
}
