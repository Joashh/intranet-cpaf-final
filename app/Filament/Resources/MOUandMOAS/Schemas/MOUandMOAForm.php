<?php

namespace App\Filament\Resources\MOUandMOAS\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;

class MOUandMOAForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 Select::make('contributing_unit')
                ->options([
                    'CSPPS' => 'CSPPS',
                    'CISC' => 'CISC',
                    'IGRD' => 'IGRD',
                    'CPAf' => 'CPAf',
                ])
                ->required(),

            Select::make('partnership_type')
                ->options([
                    'Memorandum of Agreement (MOA)' => 'Memorandum of Agreement (MOA)',
                    'Memorandum of Understanding (MOU)' => 'Memorandum of Understanding (MOU)',
                    'Others' => 'Others',
                ])
                ->required()
                ->label('Type of Partnership Agreement')
                ->reactive(),
                
            TextInput::make('partnership_type_other')
                ->label('Specify Other Partnership Type')
                ->visible(fn ($get) => $get('partnership_type') === 'Others')
                ->required(fn ($get) => $get('partnership_type') === 'Others'),

            TextInput::make('extension_title')->required(),
            TextInput::make('partner_stakeholder')->required(),
            DatePicker::make('start_date')->required(),
            DatePicker::make('end_date')->required(),

            Select::make('training_courses')
                ->options(['Yes' => 'Yes', 'No' => 'No'])
                ->label('Training Courses (non-degree and non-degree)'),

            Select::make('technical_advisory_service')
                ->options(['Yes' => 'Yes', 'No' => 'No'])
                ->label('Technical/Advisory Service for external clients'),

            Select::make('information_dissemination')
                ->options(['Yes' => 'Yes', 'No' => 'No'])
                ->label('Information Dissemination/Communication through mass media'),

            Select::make('consultancy')
                ->options(['Yes' => 'Yes', 'No' => 'No'])
                ->label('Consultancy for external clients'),

            Select::make('community_outreach')
                ->options(['Yes' => 'Yes', 'No' => 'No'])
                ->label('Community Outreach or Public Service'),

            Select::make('technology_transfer')
                ->options(['Yes' => 'Yes', 'No' => 'No'])
                ->label('Technology or Knowledge Transfer to Target user/adopters in industry or the community'),

            Select::make('organizing_events')
                ->options(['Yes' => 'Yes', 'No' => 'No'])
                ->label('Organizing such as symposium, forum, exhibit, performance, conference'),

            Textarea::make('scope_of_work')->nullable(),
            TextInput::make('documents_file_path')
                ->label('Documents File URL')
                ->placeholder('https://drive.google.com/...')
                ->url()
                ->maxLength(500),
            ]);
    }
}
