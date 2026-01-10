<?php

namespace App\Livewire\Items;

use App\Models\Item;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;

class EditItem extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public Item $record;

    public ?array $data = [];

    public function mount(Item $item): void
    {
        $this->record = $item;
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {

        return $schema
            ->components([
                Section::make('Edit Item')
                    ->schema([
                        TextInput::make('name')
                            ->label('Item Name')
                            ->required()
                        ,
                        TextInput::make('qty')
                            ->required()
                            ->numeric(),
                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('EGP'),
                        Toggle::make('status')
                            ->label(' Is Active')
                            ->inline(false)
                            ->required(),
                        FileUpload::make('image')
                            ->label('Image Item')
                            ->disk('items')
                            ->directory('/')
                            ->image()
                            ->maxFiles(1)
                            ->visibility('public')
                            ->preserveFilenames()
                            ->getUploadedFileNameForStorageUsing(
                                fn($file) => str::uuid() . '.' . $file->extension()
                            ),
                    ])
                    ->columns(2)
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save()
    {
        $data = $this->form->getState();

        if (isset($data['image']) && $data['image'] !== $this->record->image) {
            if ($this->record->image && Storage::disk('items')->exists($this->record->image)) {
                Storage::disk('items')->delete($this->record->image);
            }
        }

        $this->record->update($data);
        Notification::make()
            ->title('Item Update')
            ->body('Item Updated Successfully')
            ->success()
            ->send();

    }


    public function render(): View
    {
        return view('livewire.items.edit-item');
    }
}
