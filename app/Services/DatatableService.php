<?php

namespace App\Services;

use App\Enums\DocumentStatus;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DatatableService
{

    public function financialDocumentColumns(): array
    {
        return [
            TextColumn::make('name')
                ->sortable()
                ->limit(15),

            TextColumn::make('flow_type')
                ->label('Flow Type')
                ->badge(),

            TextColumn::make('amount')
                ->sortable(),

            TextColumn::make('currency')
                ->badge(),

            TextColumn::make('issue_date')
                ->date(),

            TextColumn::make('due_date')
                ->date(),

            TextColumn::make('status')
                ->badge()
                ->color(fn(DocumentStatus $state): string => match ($state) {
                    DocumentStatus::DRAFT->value => 'gray',
                    DocumentStatus::VALIDATED->value => 'warning',
                    DocumentStatus::PAID->value => 'success',
                    DocumentStatus::ARCHIVED->value => 'danger',
                    default => 'secondary',
                }),

            TextColumn::make('created_at')
                ->since(),
        ];
    }
}
