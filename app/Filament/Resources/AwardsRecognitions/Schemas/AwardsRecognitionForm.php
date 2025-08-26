<?php

namespace App\Filament\Resources\AwardsRecognitions\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;


class AwardsRecognitionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 Select::make('award_type')
                    ->label('Type of Award')
                    ->required()
                    ->options([
                        'International Publication Awards' => 'International Publication Awards',
                        'Other Notable Awards' => 'Other Notable Awards',
                    ])
                    ->reactive(),

                TextInput::make('award_title')
                    ->label('Title of Paper or Award')
                    ->helperText('Please include title if Publication or Presentation')
                    ->required()
                    ->maxLength(255),

                TextInput::make('name')
                    ->label('Name(s) of Awardee/Recipient')
                    ->required()
                    ->maxLength(255),

                TextInput::make('granting_organization')
                    ->label('Granting Organization')
                    ->required()
                    ->maxLength(255),

                DatePicker::make('date_awarded')
                    ->label('Date Awarded')
                    ->required(),
            ]);
    }
}
