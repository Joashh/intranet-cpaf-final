<?php

namespace App\Filament\Resources\MOUandMOAS\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;

class MOUandMOASTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('contributing_unit')->sortable()->label('Contributing Unit')->searchable(),
                BadgeColumn::make('partnership_type')
                    ->label('Partnership Type')
                    ->sortable(),

                TextColumn::make('extension_title')
                    ->searchable()
                    ->label('Extension Title')
                    ->tooltip(fn ($state) => strlen($state) > 30 ? $state : null)
                    ->formatStateUsing(fn ($state) => strlen($state) > 30 ? substr($state, 0, 30) . '...' : $state),
                TextColumn::make('partner_stakeholder')->label('Partner Stakeholder')->searchable(),
                TextColumn::make('start_date')->date('Y-m-d')->sortable(),
                TextColumn::make('end_date')->date('Y-m-d')->sortable(),
                
                BadgeColumn::make('training_courses')
                    ->label('Training Courses')
                    ->alignCenter()
                    ->color(fn ($state) => match (strtolower(trim($state))) {
                        'yes' => 'success',
                        'no' => 'warning',
                        default => 'secondary',
                    }),

                BadgeColumn::make('technical_advisory_service')
                    ->label('Technical/Advisory Service')
                    ->alignCenter()
                    ->color(fn ($state) => match (strtolower(trim($state))) {
                        'yes' => 'success',
                        'no' => 'warning',
                        default => 'secondary',
                    }),

                BadgeColumn::make('information_dissemination')
                    ->label('Info Dissemination')
                    ->alignCenter()
                    ->color(fn ($state) => match (strtolower(trim($state))) {
                        'yes' => 'success',
                        'no' => 'warning',
                        default => 'secondary',
                    }),

                BadgeColumn::make('consultancy')
                    ->label('Consultancy')
                    ->alignCenter()
                    ->color(fn ($state) => match (strtolower(trim($state))) {
                        'yes' => 'success',
                        'no' => 'warning',
                        default => 'secondary',
                    }),

                BadgeColumn::make('community_outreach')
                    ->label('Community Outreach')
                    ->alignCenter()
                    ->color(fn ($state) => match (strtolower(trim($state))) {
                        'yes' => 'success',
                        'no' => 'warning',
                        default => 'secondary',
                    }),

                BadgeColumn::make('technology_transfer')
                    ->label('Technology Transfer')
                    ->alignCenter()
                    ->color(fn ($state) => match (strtolower(trim($state))) {
                        'yes' => 'success',
                        'no' => 'warning',
                        default => 'secondary',
                    }),

                BadgeColumn::make('organizing_events')
                    ->label('Organizing Events')
                    ->alignCenter()
                    ->color(fn ($state) => match (strtolower(trim($state))) {
                        'yes' => 'success',
                        'no' => 'warning',
                        default => 'secondary',
                    }),

                
                TextColumn::make('documents_file_path')
                    ->label('File')
                    ->formatStateUsing(fn ($state) => $state ? '🔗 View File' : 'None')
                    ->url(fn ($record) => $record->documents_file_path)
                    ->openUrlInNewTab()
                    ->color('primary'),
            ])
            ->defaultSort('start_date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('partnership_type')
                    ->options([
                        'Memorandum of Agreement (MOA)' => 'MOA',
                        'Memorandum of Understanding (MOU)' => 'MOU',
                        'Others' => 'Others',
                    ]),
                 Tables\Filters\Filter::make('start_date_range')
                    ->form([
                        DatePicker::make('start_from')->label('Start Date From'),
                        DatePicker::make('start_until')->label('Start Date Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['start_from'], fn ($q) => $q->whereDate('start_date', '>=', $data['start_from']))
                            ->when($data['start_until'], fn ($q) => $q->whereDate('start_date', '<=', $data['start_until']));
                    })
                    ->label('Start Date Range'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkAction::make('exportBulk')
                    ->label('Export Selected')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->form([
                        Select::make('type')
                            ->label('Document Type')
                            ->options([
                                'ALL' => 'All Selected',
                                'MOA' => 'MOA',
                                'MOU' => 'MOU',
                            ])
                            ->default('ALL'),
                        Select::make('format')
                            ->label('Export Format')
                            ->options([
                                'csv' => 'CSV',
                                'pdf' => 'PDF',
                            ])
                            ->required(),
                    ])
                    ->action(function (array $data, $records) {
                        
                    }),
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
