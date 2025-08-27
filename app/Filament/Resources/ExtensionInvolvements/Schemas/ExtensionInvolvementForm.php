<?php

namespace App\Filament\Resources\ExtensionInvolvements\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

use Illuminate\Support\Facades\Auth;
use Filament\Schemas\Components\Section;

class ExtensionInvolvementForm
{
    
    public static function configure(Schema $schema): Schema
    {
        
        return $schema
   
    ->components([
        Section::make('Details')
            ->description('Details of the Extension Involvement.')
            ->schema([
                Hidden::make('user_id')
            ->default(Auth::id()),

        TextInput::make('name')
            ->label('Full Name')
            ->default(function () {
                $name = Auth::user()->name . ' ' . Auth::user()->last_name;
                $titles = ['Dr.', 'Prof.', 'Engr.', 'Sir', 'Ms.', 'Mr.', 'Mrs.'];
                $cleaned = str_ireplace($titles, '', $name);
                return preg_replace('/\s+/', ' ', trim($cleaned));
            })
            ->formatStateUsing(fn ($state) => preg_replace('/\s+/', ' ', trim($state)))
            ->dehydrated()
            ->required(),

        Select::make('extension_involvement')
            ->label('Type of Extension Involvement')
            ->options([
                'Resource Person' => 'Resource Person',
                'Seminar Speaker' => 'Seminar Speaker',
                'Reviewer' => 'Reviewer',
                'Evaluator' => 'Evaluator',
                'Moderator' => 'Moderator',
                'Session Chair' => 'Session Chair',
                'Editor' => 'Editor',
                'Examiner' => 'Examiner',
                'Other' => 'Other (Specify)',
            ])
            ->required()
            ->live()
            ->afterStateUpdated(function ($state, $set, $get) {
                if ($state !== 'Other') {
                    $set('other_type', null);
                }
            }),

        TextInput::make('other_type')
            ->label('Specify Other Type of Extension')
            ->maxLength(255)
            ->visible(fn ($get) => $get('extension_involvement') === 'Other')
            ->afterStateUpdated(function ($state, $set, $get) {
                if ($get('extension_involvement') === 'Other') {
                    $set('extension_involvement', $state);
                }
            }),

        Select::make('extensiontype')
            ->label('Type of Extension')
            ->options([
                'Training' => 'Training',
                'Conference' => 'Conference',
                'Editorial Team/Board' => 'Editorial Team/Board',
                'Workshop' => 'Workshop',
                'Other' => 'Other (Specify)',
            ])
            ->reactive()
            ->live()
            ->afterStateUpdated(function ($state, $set, $get) {
                if ($state !== 'Other') {
                    $set('other_types', null);
                }
            }),

        TextInput::make('other_types')
            ->label('Specify Other Type of Extension')
            ->maxLength(255)
            ->visible(fn ($get) => $get('extensiontype') === 'Other')
            ->afterStateUpdated(function ($state, $set, $get) {
                if ($get('extensiontype') === 'Other') {
                    $set('extensiontype', $state);
                }
            }),

        TextInput::make('event_title')
            ->label("Event Title")
            ->required(),

        TextInput::make('venue')
            ->label("Venue and Location")
            ->required(),
            ])->columns(1),

        Forms\Components\DatePicker::make('activity_date'),
    ])->columns(1);
            }
}
