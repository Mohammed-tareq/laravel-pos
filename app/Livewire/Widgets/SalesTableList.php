<?php

namespace App\Livewire\Widgets;

use App\MOdels\Sale;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class SalesTableList extends TableWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Sale::query()->with(['customer','paymentMethod',]))
            ->columns([
                TextColumn::make('customer.name')
                    ->label('Customer Name')
                    ->badge()
                    ->sortable(),
                TextColumn::make('paymentMethod.name')
                    ->badge()
                    ->color('red')
                    ->sortable(),
                TextColumn::make('total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('discount')
                    ->numeric()
                    ->badge()
                    ->color('danger')
                    ->sortable(),
                TextColumn::make('paid_amount')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
