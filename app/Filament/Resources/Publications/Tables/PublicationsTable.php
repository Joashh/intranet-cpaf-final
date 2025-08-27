<?php

namespace App\Filament\Resources\Publications\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;

class PublicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // SECTION 1 of 5: Author and Publication Info
                TextColumn::make('name')->label('Name')->sortable()->searchable(),
                BadgeColumn::make('contributing_unit')->label('Contributing Unit')->searchable()->sortable()->limit(20),
                TextColumn::make('type_of_publication')->label('Type of Publication')->searchable()->sortable()->limit(20)->tooltip(fn($state) => $state),
                TextColumn::make('title_of_publication')->label('Title of Publication')->searchable()->sortable()->limit(20)->tooltip(fn($state) => $state),
                TextColumn::make('co_authors')->label('Co-author(s)')->searchable()->sortable()->limit(20)->tooltip(fn($state) => $state),

                // SECTION 2 of 5: Journal & Publisher Info
                TextColumn::make('research_conference_publisher_details')->label('Research/Conference/Publisher Details')->searchable()->limit(20)->sortable()->tooltip(fn($state) => $state),
                TextColumn::make('study_research_project')->label('Study/Research Project')->searchable()->limit(20)->sortable()->tooltip(fn($state) => $state),
                TextColumn::make('journal_book_conference')->label('Journal/Book/Conference Name')->sortable()->searchable()->limit(20)->tooltip(fn($state) => $state),
                TextColumn::make('publisher_organizer')->label('Publisher/Organizer')->sortable()->searchable()->limit(20)->tooltip(fn($state) => $state),
                TextColumn::make('type_of_publisher')->label('Type of Publisher')->sortable()->searchable()->limit(20)->tooltip(fn($state) => $state),
                TextColumn::make('location_of_publisher')->label('Location of Publisher')->sortable()->searchable()->limit(20)->tooltip(fn($state) => $state),
                TextColumn::make('editors')->label('Editor(s)')->sortable()->searchable()->limit(20)->tooltip(fn($state) => $state),
                TextColumn::make('volume_issue')->label('Volume/Issue')->sortable()->searchable()->limit(20)->tooltip(fn($state) => $state),
                TextColumn::make('date_published')->label('Date Published')->date()->sortable()->limit(20),
                TextColumn::make('conference_start_date')->label('Conference Start')->date()->sortable(),
                TextColumn::make('conference_end_date')->label('Conference End')->date()->sortable(),
                TextColumn::make('conference_venue')->label('Conference Venue')->searchable()->sortable()->limit(20)->tooltip(fn($state) => $state),

                //COPY DOI OR LINK TO OTHER LINKS FROM SECTION 4
                TextColumn::make('doi_or_link')
                    ->label('DOI / Link')
                    ->url(
                        fn($record) =>
                        str_starts_with($record->doi_or_link, 'http')
                        ? $record->doi_or_link
                        : 'https://doi.org/' . ltrim($record->doi_or_link, '/')
                    )
                    ->openUrlInNewTab()
                    ->limit(30)
                    ->sortable()
                    ->searchable()
                    ->tooltip(fn($state) => $state),
                //

                TextColumn::make('isbn_issn')->label('ISBN/ISSN')->searchable()->sortable(),

                // SECTION 3 of 5: Indexing and Citations
                TextColumn::make('collection_database')->label('Collection Database')->sortable()->searchable()->limit(20)->tooltip(fn($state) => $state),
                TextColumn::make('web_science')->label('Web Science')->sortable()->alignCenter()->searchable()->badge()->formatStateUsing(fn($state) => $state === 'YES' ? 'Yes' : 'No')->color(fn($state) => $state === 'YES' ? 'success' : 'danger'),
                TextColumn::make('scopus')->label('Scopus')->alignCenter()->sortable()->searchable()->badge()->formatStateUsing(fn($state) => $state === 'YES' ? 'Yes' : 'No')->color(fn($state) => $state === 'YES' ? 'success' : 'danger'),
                TextColumn::make('science_direct')->label('Science Direct')->sortable()->alignCenter()->searchable()->badge()->formatStateUsing(fn($state) => $state === 'YES' ? 'Yes' : 'No')->color(fn($state) => $state === 'YES' ? 'success' : 'danger'),
                TextColumn::make('pubmed')->label('PubMed/MEDLINE')->sortable()->alignCenter()->searchable()->badge()->formatStateUsing(fn($state) => $state === 'YES' ? 'Yes' : 'No')->color(fn($state) => $state === 'YES' ? 'success' : 'danger'),
                TextColumn::make('ched_journals')->label('CHED-Recognized Journals')->sortable()->alignCenter()->searchable()->badge()->formatStateUsing(fn($state) => $state === 'YES' ? 'Yes' : 'No')->color(fn($state) => $state === 'YES' ? 'success' : 'danger'),
                TextColumn::make('other_reputable_collection')->label('Other Reputable Collection/Database')->sortable()->searchable()->limit(20)->tooltip(fn($state) => $state),
                TextColumn::make('citations')->label('Citations')->sortable()->sortable()->limit(20)->tooltip(fn($state) => $state)->alignCenter(),

                // SECTION 4 of 5: Proofs
                TextColumn::make('pdf_proof_1')
                    ->label('PDF Proof 1')
                    ->sortable()
                    ->url(fn($record) =>
                        str_starts_with($record->pdf_proof_1, 'http')
                        ? $record->pdf_proof_1
                        : 'https://drive.google.com/' . ltrim($record->pdf_proof_1, '/'))
                    ->openUrlInNewTab()
                    ->limit(20)
                    ->searchable()
                    ->tooltip(fn($state) => $state),

                TextColumn::make('pdf_proof_2')
                    ->label('PDF Proof 2')
                    ->sortable()
                    ->url(
                        fn($record) =>
                        str_starts_with($record->pdf_proof_2, 'http')
                        ? $record->pdf_proof_2
                        : 'https://drive.google.com/' . ltrim($record->pdf_proof_2, '/')
                    )
                    ->openUrlInNewTab()
                    ->limit(30)
                    ->searchable()
                    ->tooltip(fn($state) => $state),

                // SECTION 5 of 5: Awards
                TextColumn::make('received_award')->sortable()->label('Received Award')->badge()->formatStateUsing(fn($state) => $state === 'YES' ? 'Yes' : 'No')->color(fn($state) => $state === 'YES' ? 'success' : 'danger')->alignCenter(),
                TextColumn::make('award_title')->sortable()->label('Award Title')->searchable()->tooltip(fn($state) => $state),
                TextColumn::make('date_awarded')->sortable()->label('Date Awarded')->date(),
            ])
            ->filters([
                Filter::make('date_published')
                    ->form([
                        DatePicker::make('from')->label('From'),
                        DatePicker::make('until')->label('Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], fn($query, $date) => $query->whereDate('date_published', '>=', $date))
                            ->when($data['until'], fn($query, $date) => $query->whereDate('date_published', '<=', $date));
                    }),
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
