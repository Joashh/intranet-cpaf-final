<?php

namespace App\Filament\Pages;


use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class Dashboard extends \Filament\Pages\Dashboard
{
use HasFiltersForm;
public function filtersForm(Schema $schema): Schema
{

    return $schema->components([
        Section::make('')->schema([
            DatePicker::make('StartDate')->default(now()->subMonths(12)),
            DatePicker::make('EndDate')->default(now()),
            
        ])->columns(2)
        ->columnSpan('full'),
    ]);

    
} 
}