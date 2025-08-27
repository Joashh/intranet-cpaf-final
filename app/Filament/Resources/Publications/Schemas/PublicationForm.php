<?php

namespace App\Filament\Resources\Publications\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;

use Filament\Tables\Columns\Column;
use Illuminate\Support\Facades\Auth;

class PublicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                Section::make('Section 1')
                    ->schema([
                        TextInput::make('name')->label('Full Name')->placeholder('First Name, Middle Initial, Last Name')->required(),
                        Select::make('contributing_unit')->label('Contributing Unit')->options([
                            'CISC' => 'CISC',
                            'CSPPS' => 'CSPPS',
                            'CPAF' => 'CPAF',
                            'IGRD' => 'IGRD',
                        ])->required(),

                        Select::make('type_of_publication')
                            ->label('Type of Publication')
                            ->options([
                                'Book/Monograph' => 'Book/Monograph',
                                'Book Chapter (Edited/Peer-Reviewed)' => 'Book Chapter (Edited/Peer-Reviewed)',
                                'Paper Publication (Peer-Reviewed/Refereed)' => 'Paper Publication (Peer-Reviewed/Refereed)',
                                'Paper Publication (Indexed Journal)' => 'Paper Publication (Indexed Journal)',
                                'Journal Article (Peer-Reviewed)' => 'Journal Article (Peer-Reviewed)',
                                'Other' => 'Other...',
                            ])
                            ->live()
                            ->required()
                            ->afterStateUpdated(function ($state, $set) {

                                if ($state !== 'Other') {
                                    $set('other_type', null);
                                }
                            }),

                        TextInput::make('other_type')
                            ->label('Other (please specify)')
                            ->maxLength(255)
                             ->visible(fn ($get) => $get('type_of_publication') === 'Other')
                            ->afterStateUpdated(function ($state, $set, $get) {
                                
                                if ($get('type_of_publication') === 'Other') {
                                    $set('type_of_publication', $state);
                                }
                            }),

                        TextInput::make('title_of_publication')->label('Title of Publication')->placeholder('Enter the title of the publication')->required()->maxLength(255),
                        Textarea::make('co_authors')->label('Co-author(s)')->placeholder("Specify the lead author first. Separate co-authors with semi-colons.\nExample: John Doe; Jane Smith; Alex Johnson")->helperText('')->required()->rows(3),
                    ])->columns(2),

                Section::make('Section 2')
                    ->schema([
                        Textarea::make('research_conference_publisher_details')->label('Research/Conference/Publisher details')->placeholder("Do not leave the box blank. Please put 'NA' if you have no answers. Thank you!")->required()->rows(2),
                        Textarea::make('study_research_project')->label('Study/Research Project where the publication resulted from')->placeholder('Enter details')->rows(2),
                        Textarea::make('journal_book_conference')->label('Name of Journal/Book/Conference Publication')->placeholder('Enter the name')->rows(2),
                        Textarea::make('publisher_organizer')->label('Publisher/Name of Organizer')->placeholder('Enter the name')->maxLength(255)->rows(2),
                        Select::make('type_of_publisher')->label('Type of Publisher')->options([
                            'Commercial' => 'Commercial',
                            'Learned Society and Association' => 'Learned Society and Association',
                            'University Press' => 'University Press',
                        ])->required(),
                        Select::make('location_of_publisher')->label('Location of Publisher')->options([
                            'Local' => 'Local',
                            'International' => 'International',
                        ])->required(),
                        Textarea::make('editors')->label('Name of Editor(s)')->placeholder("Separate editors' names with semi-colons.\nExample: John Doe; Jane Smith; Alex Johnson ")->rows(3),
                        TextInput::make('volume_issue')->label('Volume No. and Issue No.')->placeholder('Ex: Volume 1 Issue 3')->maxLength(255),
                        Grid::make(3)->schema([
                            DatePicker::make('date_published')->label('Date Published or Accepted')->placeholder('Select date')->required(),
                            DatePicker::make('conference_start_date')->label('Conference START Date')->placeholder('Select start date'),
                            DatePicker::make('conference_end_date')->label('Conference END Date')->placeholder('Select end date'),
                        ]),
                        Textarea::make('conference_venue')->label('Conference Venue, City, and Country')->placeholder('Enter location details')->rows(2),
                        TextInput::make('doi_or_link')->label('DOI or Link')->placeholder('Specify DOI or URL')->url()->required(),

                        Select::make('isbn_issn')->label('ISBN or ISSN')->options([
                            'ISBN' => 'ISBN',
                            'ISSN' => 'ISSN'
                        ]),
                    ])->columns(2),

                Section::make('Section 3')
                    ->schema([

                        Textarea::make('collection_database')->placeholder('Indicate the Collection/Database where this Journal/Book/Conference Publication has been indexed/catalogued/recognized')->helperText('Do not leave the box blank. Please put "NA" if you have no answers. Thank you!')->required(),
                        Radio::make('web_science')->label('Web Science (formerly ISI)')->options(['YES' => 'YES', 'NO' => 'NO'])->inline()->required(),
                        Radio::make('scopus')->label("Elsevier's Scopus")->options(['YES' => 'YES', 'NO' => 'NO'])->inline()->required(),
                        Radio::make('science_direct')->label("Elsevier's ScienceDirect")->options(['YES' => 'YES', 'NO' => 'NO'])->inline()->required(),
                        Radio::make('pubmed')->label('PubMed/MEDLINE')->options(['YES' => 'YES', 'NO' => 'NO'])->inline()->required(),
                        Radio::make('ched_journals')->label('CHED-Recognized Journals')->options(['YES' => 'YES', 'NO' => 'NO'])->inline()->required(),
                        Textarea::make('other_reputable_collection')->label('Other Reputable Collection/Database')->placeholder('Leave blank if there is no such other database.'),
                        TextInput::make('citations')->label('Number of Citations')->numeric()->placeholder('If none, please put zero (0).')->required(),
                    ])->columns(1),

                Section::make('Section 4')
                  ->description('Kindly input the link to the proofs below. Do not leave the box blank. Please put "NA" if you have no answers. Thank you!')
                    ->schema([
                        TextInput::make('pdf_proof_1')->label('Proof of Publication 1')->placeholder('Input the Google Drive link to the proof')->required(),
                        TextInput::make('pdf_proof_2')->label('Proof of Publication 2')->placeholder('Input the Google Drive link to the proof (if applicable)'),
                    ])
                    ->columns(2),

                Section::make('Section 5')
                    ->schema([
                        Radio::make('received_award')->label('Received Award')->options(['YES' => 'YES', 'NO' => 'NO'])->required(),
                        Textarea::make('award_title')->label('Award Title')->placeholder("Do not leave the box blank. Please put 'NA' if you have no answers. Thank you!")->nullable(),
                        Grid::make(5)->schema([
                            DatePicker::make('date_awarded')->label('Date Awarded')->nullable()
                        ]),
                    ]),

            ])->columns(1);
    }
}
