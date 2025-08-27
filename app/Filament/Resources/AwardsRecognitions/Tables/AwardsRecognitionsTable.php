<?php

namespace App\Filament\Resources\AwardsRecognitions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\BulkAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Placeholder;
use Illuminate\Database\Eloquent\Builder;

class AwardsRecognitionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                 TextColumn::make('award_type')
                    ->label('Type of Award')
                    ->sortable()
                    ->searchable()
                    ->tooltip(fn($state) => $state)
                    ->placeholder('N/A'),

                TextColumn::make('award_title')
                    ->label('Title of Paper or Award')
                    ->sortable()
                    ->searchable()
                    ->limit(20)
                    ->placeholder('N/A')
                    ->tooltip(fn($state) => $state),

                TextColumn::make('name')
                    ->label('Name(s) of Awardee/Recipient')
                    ->sortable()
                    ->searchable()
                    ->limit(20)
                    ->placeholder('N/A')
                    ->tooltip(fn($state) => $state),

                TextColumn::make('granting_organization')
                    ->label('Granting Organization')
                    ->sortable()
                    ->searchable()
                    ->limit(20)
                    ->placeholder('N/A')
                    ->tooltip(fn($state) => $state),

                TextColumn::make('date_awarded')
                    ->label('Date Awarded')
                    ->date()
                    ->sortable()
                    ->placeholder('N/A'),
            ])
            ->filters([
                SelectFilter::make('award_type')
                    ->label('Type of Awards')
                    ->options([
                        'International Publication Awards' => 'International Publication Awards',
                        'Other Notable Awards' => 'Other Notable Awards',

                    ])
                    ->query(function ($query, $data) {
                        if (!empty($data['value'])) {
                            return $query->where('award_type', $data['value']);
                        }
                        return $query;
                    }),
                Filter::make('date_awarded')
                    ->label('Date Awarded')
                    ->form([
                        DatePicker::make('from')->label('From'),
                        DatePicker::make('until')->label('Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], fn ($q) => $q->whereDate('date_awarded', '>=', $data['from']))
                            ->when($data['until'], fn ($q) => $q->whereDate('date_awarded', '<=', $data['until']));
                    }),
            ])
            ->recordActions([
                EditAction::make(),
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                     BulkAction::make('Delete Selected')
                    ->label('Delete Selected')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->action(fn ($records) => $records->each->delete()),

                BulkAction::make('exportBulk')
                    ->label('Export Selected')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Select::make('format')
                            ->options([
                                'csv' => 'CSV',
                                'pdf' => 'PDF',
                            ])
                            ->label('Export Format')
                            ->required(),
                    ])
                    
                ]),
            ]);
    }
}
