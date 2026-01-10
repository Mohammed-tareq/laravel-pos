<?php

namespace App\Livewire\Widgets;

use App\Models\Sale;
use App\Models\SaleItem;
use Filament\Widgets\ChartWidget;

class SalesChart extends ChartWidget
{
    protected ?string $heading = 'Sales Chart';

    protected function getData(): array
    {
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $backgroundColors = [
            '#FF6384', // Jan
            '#36A2EB', // Feb
            '#FFCE56', // Mar
            '#4BC0C0', // Apr
            '#9966FF', // May
            '#FF9F40', // Jun
            '#C9CBCF', // Jul
            '#8BC34A', // Aug
            '#E91E63', // Sep
            '#00BCD4', // Oct
            '#9C27B0', // Nov
            '#FF5722', // Dec
        ];


        $count = 12;
        $dataLoob = [];
        for ($i = 1; $i <= $count; $i++) {
            $months = Sale::whereMonth('created_at', $i)->count();
            $dataLoob[] = $months;
        }
        $data = [
            'datasets' => [
                [
                    'label' => 'Sales created',
                    'data' => $dataLoob,
                    'backgroundColor' => $backgroundColors,
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' =>$labels,
        ];
        return $data;
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
