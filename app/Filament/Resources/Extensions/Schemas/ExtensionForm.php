<?php

namespace App\Filament\Resources\Extensions\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;


class ExtensionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 Select::make('contributing_unit')->label('Contributing Unit')
                ->options([
                    'CSPPS' => 'CSPPS',
                    'CISC' => 'CISC',
                    'CPAf' => 'CPAf',
                    'IGRD' => 'IGRD',
                ])->required(),

                DatePicker::make('start_date')
                ->label('Start Date (mm/dd/yyyy)')
                ->format('Y/m/d')->required(),

                DatePicker::make('end_date')
                ->label('End Date based on actual completion')
                ->format('Y/m/d')->required(),

                DatePicker::make('extension_date')
                ->label('Extension Date')
                ->format('Y/m/d'),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'Completed' => 'Completed',
                        'On-going' => 'On-going',
                    ])->required(),

                TextInput::make('title_of_extension_program')
                ->label('Title of Extension Program')
                ->required(),

                Textarea::make('objectives')
                ->label('Objectives'),

                Textarea::make('expected_output')
                ->label('Expected Output/Scope of Work'),

                TextInput::make('original_timeframe_months')
                ->label('Number of Months in Original Timeframe')
                ->numeric(),

                TextInput::make('researcher_names')
                ->label('Name of Researcher/s or Extensionist')
                ->required(),

                TextInput::make('project_leader')->label('Project Leader'),

                TextInput::make('source_of_funding')->label('Source of Funding'),
                TextInput::make('budget')->label('Budget')->numeric(),
                TextInput::make('type_of_funding')->label('Type of Funding'),
                TextInput::make('fund_code')->label('Fund Code'),

                TextInput::make('pdf_image_file')->label('PDF Image File')->placeholder('Input URL here'),

                Textarea::make('training_courses')->label('Training Courses (non-degree and non-credit)'),
                Textarea::make('technical_service')->label('Technical/Advisory Service for external clients'),
                Textarea::make('info_dissemination')->label('Information Dissemination/Communication through mass media'),
                Textarea::make('consultancy_service')->label('Consultancy for external clients'),
                Textarea::make('community_outreach')->label('Community Outreach or Public Service'),
                Textarea::make('knowledge_transfer')->label('Technology or Knowledge Transfer'),
                Textarea::make('organizing_events')->label('Organizing such as symposium, forum, exhibit, etc.'),

                Textarea::make('benefited_academic_programs')->label('Academic Degree Programs Benefited'),

                TextInput::make('target_beneficiary_count')->label('Number of Target Beneficiary Groups or Persons Served')->numeric(),
                TextInput::make('target_beneficiary_group')->label('Target Beneficiary Group'),
                TextInput::make('funding_source')->label('Source of Majority Share of Funding for this Training'),
                Textarea::make('role_of_unit')->label('Role of Unit and Total Hrs. Spent'),

                TextInput::make('unit_theme')->label('Unit Theme'),
                TextInput::make('sdg_theme')->label('SDG Theme'),
                TextInput::make('agora_theme')->label('AGORA Theme'),
                TextInput::make('cpaf_re_theme')->label('CPAf R&E Theme (GoRABeLS)'),

                Select::make('ccam_initiatives')->label('Change and Mitigation (CCAM) Initiatives (Y/N)')
                    ->options(['Y' => 'Yes', 'N' => 'No']),
                Select::make('drrms')->label('Disaster Risk Reduction and Management Service (DRRMS) (Y/N)')
                    ->options(['Y' => 'Yes', 'N' => 'No']),

                Textarea::make('project_article')->label('Project Article'),
                TextInput::make('pbms_upload_status')->label('PBMS Uploading Status'),
            ]);
    }
}
