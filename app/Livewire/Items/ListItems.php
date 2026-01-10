<?php

namespace App\Livewire\Items;

use App\Models\Item;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Notifications\Notification;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;


class ListItems extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn(): Builder => Item::query())
            ->columns([

                TextColumn::make('index')
                    ->label('#')
                    ->rowIndex()
                    ->badge()
                    ->width('bold')
                    ->alignCenter(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable(),
                TextColumn::make('qty')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('price')
                    ->money('EGP')
                    ->sortable(),
                ImageColumn::make('image')
                    ->label('Item Image')
                    ->disk('items')
                    ->height(60)
                    ->circular(),

                IconColumn::make('status')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('add')
                    ->url(fn(): string => route('item.create'))
                    ->label('Add Item')
                    ->icon('heroicon-o-plus'),
            ])
            ->recordActions([
                Action::make('delete')
                    ->requiresConfirmation()
                    ->label('')
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->action(fn(Item $item) => $item->delete())
                    ->successNotification(
                        Notification::make()
                            ->title('Item Delete')
                            ->body('Item Deleted Successfully')
                            ->success()
                    ),
                Action::make('edit')
                    ->url(fn(Item $record): string => route('item.update', $record))
                    ->label('')
                    ->icon('heroicon-o-pencil-square'),

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ])
            ->actionsColumnLabel('Actions');

    }

    public function render(): View
    {
        return view('livewire.items.list-items');
    }
}
