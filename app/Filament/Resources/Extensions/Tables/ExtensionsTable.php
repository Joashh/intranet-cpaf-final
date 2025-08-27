<?php

namespace App\Filament\Resources\Extensions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;


class ExtensionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
              
    BadgeColumn::make('contributing_unit')
        ->label('Contributing Unit')
        ->sortable()
        ->searchable()
        ->placeholder('N/A'),

    TextColumn::make('start_date')
        ->label('Start Date')
        ->sortable()
        ->placeholder('N/A'),

    TextColumn::make('end_date')
        ->label('End Date')
        ->sortable()
        ->placeholder('N/A'),

    TextColumn::make('extension_date')
        ->label('Extension Date')
        ->sortable()
        ->placeholder('N/A'),

    BadgeColumn::make('status')
        ->label('Status')
        ->color(fn ($state) => match ($state) {
            'Completed' => 'success',
            'On-going' => 'warning',
            default => 'secondary',
        })
        ->placeholder('N/A'),

    TextColumn::make('title_of_extension_program')
        ->label('Title of Extension Program')
        ->sortable()
        ->searchable()
        ->limit(50)
        ->tooltip(fn ($state) => $state)
        ->placeholder('N/A'),

    TextColumn::make('objectives')
        ->label('Objectives')
        ->limit(50)
        ->searchable()
        ->placeholder('N/A'),

    TextColumn::make('expected_output')
        ->label('Expected Output/Scope of Work')
        ->limit(50)
        ->searchable()
        ->placeholder('N/A'),

    TextColumn::make('original_timeframe_months')
        ->label('Number of Months')
        ->sortable()
        ->placeholder('N/A'),

    TextColumn::make('researcher_names')
        ->label('Name of Researcher/s')
        ->sortable()
        ->searchable()
        ->limit(50)
        ->tooltip(fn ($state) => $state)
        ->placeholder('N/A'),

    TextColumn::make('project_leader')
        ->label('Project Leader')
        ->sortable()
        ->searchable()
        ->placeholder('N/A'),

    TextColumn::make('source_of_funding')
        ->label('Source of Funding')
        ->sortable()
        ->placeholder('N/A'),

    TextColumn::make('budget')
        ->label('Budget')
        ->sortable()
        ->placeholder('N/A'),

    TextColumn::make('type_of_funding')
        ->label('Type of Funding')
        ->sortable()
        ->placeholder('N/A'),

    TextColumn::make('fund_code')
        ->label('Fund Code')
        ->sortable()
        ->placeholder('N/A'),

    TextColumn::make('pbms_upload_status')
        ->label('PBMS Uploading Status')
        ->sortable()
        ->placeholder('N/A'),

            ])
            ->filters([
                SelectFilter::make('contributing_unit')
                    ->options([
                        'CSPPS' => 'CSPPS',
                        'CISC' => 'CISC',
                        'CPAf' => 'CPAf',
                        'IGRD' => 'IGRD',
                    ]),
                Filter::make('start_date_range')
                    ->form([
                        DatePicker::make('from')->label('Start Date From'),
                        DatePicker::make('until')->label('Start Date To'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], fn (Builder $query, $date) => 
                                $query->whereDate('start_date', '>=', $date))
                            ->when($data['until'], fn (Builder $query, $date) => 
                                $query->whereDate('start_date', '<=', $date));
                    }),
            ])

            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])

            ->bulkActions([
                DeleteBulkAction::make(),

            ])
            
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
