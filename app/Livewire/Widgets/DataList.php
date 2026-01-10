<?php

namespace App\Livewire\Widgets;

use App\Models\Customer;
use App\Models\Item;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DataList extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make('Customers', Customer::count())
                ->label('Customers')
                ->icon('heroicon-o-user'),
            Stat::make('Items', Item::count())
                ->label('Customers')
                ->icon('heroicon-o-building-storefront'),
            Stat::make('cashier', User::count())
                ->label('Customers')
                ->icon('heroicon-o-user-group'),
        ];
    }
}
