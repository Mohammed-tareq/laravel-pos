<?php

namespace App\Livewire\Items;

use App\Models\Item;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateItem extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Create Item')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->unique(),
                        TextInput::make('sku')
                            ->label('SKU')
                            ->required(),
                        TextInput::make('qty')
                            ->required()
                            ->numeric(),
                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('EGP'),
                        Toggle::make('status')
                            ->label('Is Active')
                            ->required()
                            ->inline(false)
                    ])
                ->columns(2)
            ])
            ->statePath('data')
            ->model(Item::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Item::create($data);

        $this->form->model($record)->saveRelationships();
        Notification::make()
            ->title('Item Create')
            ->body('Item Created Successfully')
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.items.create-item');
    }
}
