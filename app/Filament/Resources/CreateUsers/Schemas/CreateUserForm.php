<?php

namespace App\Filament\Resources\CreateUsers\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Illuminate\Validation\Rules\Password;


class CreateUserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 Section::make('Primary Information')
                    ->description('Fill up the following:')
                    ->schema([
                        TextInput::make('name')->label('First Name')->required(),
                        TextInput::make('email')->label('Email')->email()->required(),
                        TextInput::make('last_name')->label('Last Name')->required(),
                        TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->minLength(6)
                            ->same('password_confirmation')
                            ->dehydrated(fn($state) => filled($state))
                            ->rule(Password::default()),
                        TextInput::make('middle_name')->label('Middle Name'),
                        TextInput::make('password_confirmation')
                            ->password()
                            ->revealable()
                            ->label('Confirm Password'),
                    ])->columns(2),

                Select::make('employment_status')->label('Employment Status')
                    ->options([
                        'Part-Time' => 'Part-Time',
                        'Temporary' => 'Temporary',
                        'Full Time' => 'Full Time',
                    ])
                    ->required(),
                TextInput::make('designation')->label('Designation/Position')
                    ->required(),
                Select::make('unit')
                    ->label('Unit')
                    ->options([
                        'DO' => 'DO',
                        'KMO' => 'KMO',
                        'IGRD' => 'IGRD',
                        'CISC' => 'CISC',
                        'CSPPS' => 'CSPPS',
                    ])
                    ->required(),
                Select::make('ms_phd')
                    ->label('Highest Degree Attained')
                    ->options([
                        "Bachelor's Degree" => "Bachelor's Degree",
                        "Master's Degree" => "Master's Degree",
                        'Doctoral Degree' => 'Doctoral Degree',
                        'Vocational/Technical' => 'Vocational/Technical',
                        'High School Diploma' => 'High School Diploma',
                        'N/A' => 'N/A',
                    ])
                    ->required(),
                Select::make('staff')
                    ->label('Staff/Classification')
                    ->options([
                        'admin' => 'Admin',
                        'faculty' => 'Faculty',
                        'REPS' => 'REPS',
                    ])
                    ->default('faculty')
                    ->required(),


                Select::make('systemrole')
                    ->label('User Role')
                    ->options([
                        'admin' => 'Admin',
                        'super-admin' => 'Super Admin',
                        'user' => 'User',
                        'secretary' => 'Secretary',
                    ])
                    ->default('user')
                    ->reactive()
                    ->afterStateUpdated(function ($state, $set, $get, $record) {
                        if ($record) {
                            $record->update(['systemrole' => $state]);
                            $record->syncRoles([$state]);
                        }
                    }),

                TextInput::make('research_interests')->label('Research Interests'),
                TextInput::make('fields_of_specialization')->label('Fields of Specialization'),
                TextInput::make('rank_')->label('Rank'),
                TextInput::make('sg')->label('SG'),
                TextInput::make('s')->label('S'),
                TextInput::make('item_no')->label('Item Number'),
                DatePicker::make('birthday')->label('Birthday')
                    ->format('Y/m/d')->required(),
                TextInput::make('yr_grad')->label('Year Graduated'),
                TextInput::make('date_hired')->label('Date Hired in CPAf'),
                TextInput::make('contact_no')->label('Contact Number'),
            ])->columns(1);
    }
}
