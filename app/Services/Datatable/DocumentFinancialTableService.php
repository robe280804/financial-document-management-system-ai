<?php

namespace App\Services\Datatable;

use App\Enums\DocumentStatus;
use App\Enums\FlowType;
use App\Models\FinancialDocument;
use App\Services\Datatable\DatatableInterface;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;

class DocumentFinancialTableService implements DatatableInterface
{

    public function makeColumns(): array
    {
        return [
            //CheckboxColumn::make('select'),

            TextColumn::make('name')
                ->weight(FontWeight::Bold)
                ->searchable()
                ->limit(15),

            TextColumn::make('flow_type')
                ->label('Flow Type')
                ->badge()
                ->color(fn(FlowType $state): string => match ($state) {
                    FlowType::INCOME => 'success',
                    FlowType::EXPENSE => 'info',
                })
                ->size(TextColumnSize::Medium),

            TextColumn::make('amount')
                ->size(TextColumnSize::Medium),

            TextColumn::make('currency'),

            TextColumn::make('issue_date')
                ->date(),

            TextColumn::make('due_date')
                ->weight(FontWeight::Bold)
                ->date(),

            TextColumn::make('status')
                ->color(fn(DocumentStatus $state): string => match ($state) {
                    DocumentStatus::DRAFT => 'warning',
                    DocumentStatus::VALIDATED => 'info',
                    DocumentStatus::PAID => 'success',
                    DocumentStatus::ARCHIVED => 'danger',
                })
                ->icon(fn(DocumentStatus $state): string => match ($state) {
                    DocumentStatus::DRAFT => 'heroicon-o-pencil',
                    DocumentStatus::VALIDATED => 'heroicon-o-clock',
                    DocumentStatus::PAID => 'heroicon-o-check-circle',
                    DocumentStatus::ARCHIVED => 'heroicon-o-archive-box',
                })
                ->size(TextColumn\TextColumnSize::Medium),

            TextColumn::make('created_at')
                ->since(),
        ];
    }

    public function makeFilters(): array
    {
        return [
            Filter::make('filter_created_at')
                ->form([
                    DatePicker::make('created_from')
                        ->label('From created at')
                        ->native(false),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'] ?? null,
                            fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                        );
                })
                ->indicateUsing(function (array $data): array {
                    $indicators = [];
                    if ($data['created_from'] ?? null) {
                        $indicators[] = 'Created at: ' . \Carbon\Carbon::parse($data['created_from'])->format('d/m/Y');
                    }
                    return $indicators;
                }),

            Filter::make('filter_issue_date')
                ->form([
                    DatePicker::make('issue_date')
                        ->label('From issued at')
                        ->native(false),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['issue_date'] ?? null,
                            fn(Builder $query, $date): Builder => $query->whereDate('issue_date', '>=', $date),
                        );
                })
                ->indicateUsing(function (array $data): array {
                    $indicators = [];
                    if ($data['issue_date'] ?? null) {
                        $indicators[] = 'Issued from: ' . \Carbon\Carbon::parse($data['issue_date'])->format('d/m/Y');
                    }
                    return $indicators;
                }),

            Filter::make('filter_incomes')
                ->label('Only incomes')
                ->toggle()
                ->query(function (Builder $query, array $data): Builder {
                    return $query->when(
                        $data['isActive'],
                        fn(Builder $query): Builder => $query->where('flow_type', FlowType::INCOME),
                    );
                }),

            Filter::make('filter_expenses')
                ->label('Only expenses')
                ->toggle()
                ->query(function (Builder $query, array $data): Builder {
                    return $query->when(
                        $data['isActive'],
                        fn(Builder $query): Builder => $query->where('flow_type', FlowType::EXPENSE),
                    );
                }),

            SelectFilter::make('status')
                ->label('Select status')
                ->multiple()
                ->options([
                    DocumentStatus::DRAFT->value => 'Draft',
                    DocumentStatus::VALIDATED->value => 'Validated',
                    DocumentStatus::PAID->value => 'Paid',
                    DocumentStatus::ARCHIVED->value => 'Archived',
                ]),
        ];
    }

    public function makeActions(): array
    {
        return [
            Action::make('edit')
                ->url(fn(FinancialDocument $document): string => route('dashboard', $document))
                ->openUrlInNewTab(),
        ];
    }

    public function makeBulkActions(): array
    {
        return [
            BulkAction::make('delete')
                ->requiresConfirmation()
                ->action(fn(FinancialDocument $document) => $document->each->delete())
                ->color('danger')
        ];
    }
}
