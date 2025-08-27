<?php

namespace App\Filament\Resources\AwardsRecognitions\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\AwardsRecognitions;
use Illuminate\Support\Str;
class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalAwards = AwardsRecognitions::count();
        $recentAward = AwardsRecognitions::latest('date_awarded')->first();
        $awardsThisYear = AwardsRecognitions::whereYear('date_awarded', now()->year)->count();


        return [
        Stat::make('Total Awards', $totalAwards)
        ->color('success')
            ->description('All awards recorded')
            ->descriptionIcon('heroicon-m-arrow-trending-up'),


        Stat::make('Awards This Year', $awardsThisYear)
        ->color('primary')
            ->description('Count of awards given this year')
            ->descriptionIcon('heroicon-m-calendar'),

        Stat::make('Most Recent Award', Str::limit($recentAward?->award_title ?? 'N/A', 10))
    ->description('Latest award entry')
    ->descriptionIcon('heroicon-m-star'),

        ];
    }
}
