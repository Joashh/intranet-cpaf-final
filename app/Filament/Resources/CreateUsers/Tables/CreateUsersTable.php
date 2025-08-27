<?php

namespace App\Filament\Resources\CreateUsers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class CreateUsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                 TextColumn::make('name')
                    ->label('Full Name')
                    ->getStateUsing(fn($record) => "{$record->name} {$record->last_name}")
                    ->searchable(['name', 'last_name'])
                    ->sortable(),

                BadgeColumn::make('unit')
                    ->label('Unit')
                    ->sortable()
                    ->alignCenter()
                    ->searchable(),

                BadgeColumn::make('staff')
                    ->label('Classification')
                    ->sortable()
                    ->searchable()
                    ->alignCenter()
                    ->colors([
                        'info' => 'faculty',
                        'success' => 'admin',
                        'warning' => 'REPS',
                    ])->formatStateUsing(fn(string $state): string => ucfirst(strtoupper($state))),

                TextColumn::make('ms_phd')
                    ->label('Highest Degree Attained')
                    ->sortable()
                    ->searchable()
                    ->limit(20)
                    ->tooltip(fn($state) => $state),

                BadgeColumn::make('systemrole')
                    ->label('User Role')
                    ->sortable()
                    ->colors([
                        'primary' => 'admin',
                        'warning' => 'super-admin',
                        'secondary' => 'user',
                        'danger' => 'secretary',
                    ])
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Contact')
                    ->sortable()
                    ->searchable(),
                BadgeColumn::make('rank_')
                    ->label('Rank')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('research_interests')
                    ->label('Research Interests')
                    ->sortable()
                    ->placeholder('No research interest found')
                    ->searchable(),
                TextColumn::make('fields_of_specialization')
                    ->label('Fields of Specialization')
                    ->placeholder('N/A')
                    ->sortable()
                    ->searchable(),
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
