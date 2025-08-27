<?php

namespace App\Filament\Resources\ExtensionInvolvements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
class ExtensionInvolvementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                 /*TextColumn::make('contributing_unit')->label('Contributing Unit')
                ->sortable()->searchable(),
                TextColumn::make('title')->label('Title')
                ->sortable()->searchable(),
                TextColumn::make('faculty.first_name')->label("Project Leader")
                ->sortable()->searchable(),
                TextColumn::make('start_date')
                ->sortable()->searchable(),
                TextColumn::make('end_date')
                ->sortable()->searchable(),
                */
                // IconColumn::make('pbms_upload_status')
                // ->icon(fn (string $state): string => match ($state) {
                //   'uploaded' => 'heroicon-o-check-badge',
                //  'pending' => 'heroicon-o-clock',

                //  })
                /*TextColumn::make('activity_date')->label('Timestamp')
                ->sortable()->searchable() ->date('F d, Y'),*/
                TextColumn::make('name')->label('Full Name')
                    ->sortable()
                    ->searchable()
                    ->limit(40)
                     ->placeholder('N/A')
                    ->tooltip(fn($state) => $state),
                TextColumn::make('extension_involvement')->label('Type of Extension Involvement')
                    ->sortable()->searchable() ->placeholder('N/A'),
                TextColumn::make('event_title')->label('Event Title')
                    ->sortable()->searchable()
                     ->placeholder('N/A')
                    ->limit(20)
                    ->tooltip(fn($state) => $state),
                TextColumn::make('created_at')->label('Start Date')
                    ->sortable()->searchable() ->placeholder('N/A'),
                TextColumn::make('extensiontype')->label('Type of Extension')
                    ->sortable()->searchable() ->placeholder('N/A'),
                TextColumn::make('venue')->label('Event Venue')
                    ->sortable()->searchable()
                    ->limit(20)
                    ->tooltip(fn($state) => $state) ->placeholder('N/A'),
                TextColumn::make('date_end')->label('End Date')
                    ->sortable()->searchable() ->placeholder('N/A'),
            ])
            ->filters([
                //
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
