<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                @livewire(\App\Livewire\Widgets\DataList::class)
        </div>
        <div class="grid auto-rows-min gap-4 md:grid-cols-2">
                @livewire(\App\Livewire\Widgets\SalesChart::class)
                @livewire(\App\Livewire\Widgets\SalesItemsChart::class)
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                @livewire(\App\Livewire\Widgets\SalesTableList::class)

        </div>
    </div>
</x-layouts.app>
