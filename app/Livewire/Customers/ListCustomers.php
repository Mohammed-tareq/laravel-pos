<?php

namespace App\Livewire\Customers;

use App\Models\Customer;
use App\Models\Item;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Notifications\Notification;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ListCustomers extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Customer::query())
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
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
                    ->url(fn(): string => route('customer.create'))
                    ->label('Add Customer')
                    ->icon('heroicon-o-plus'),
            ])
            ->recordActions([
                Action::make('delete')
                ->label('')
                ->color('danger')
                ->icon('heroicon-o-trash')
                ->action(fn(Customer $customer) => $customer->delete())
                    ->successNotification(
                        Notification::make()
                            ->title('Item Delete')
                            ->body('Item Deleted Successfully')
                            ->success()
                    ),
                Action::make('edit')
                    ->url(fn(Customer $customer): string => route('customer.update', $customer))
                ->label('')
                ->icon('heroicon-o-pencil-square'),

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.customers.list-customers');
    }
}
