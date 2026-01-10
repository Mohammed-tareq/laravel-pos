<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\Item;
use App\Models\PaymentMethod;
use App\Models\Sale;
use App\Models\SaleItem;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Pos extends Component
{

    public $search = '';
    public $items, $paymentMethods, $customers, $cart = [];

    public $customer_id = null, $payment_method_id = null;
    public $discount = 0, $paid_amount = 0;

    public function mount()
    {
        $this->customers = Customer::latest()->get();
        $this->paymentMethods = PaymentMethod::all();
        $this->items = Item::where([['status', "!=", 0], ['qty', ">", 0]])->latest()->get();
    }

    #[Computed]
    public function filteredItems()
    {
        if (empty($this->search)) {
            return $this->items;
        }

        return $this->items->filter(fn($item) => str_contains(strtolower($item->name), strtolower($this->search)));
    }

    #[Computed]
    public function subtotal()
    {
        return collect($this->cart)->sum(fn($item) => $item['price'] * $item['qty']);
    }

    #[Computed]
    public function tax()
    {
        return $this->subtotal * 0.15;
    }

    #[Computed]
    public function totalBeforeDiscount()
    {
        return $this->subtotal + $this->tax;
    }

    #[Computed]
    public function total()
    {
        $discountAmount = $this->totalBeforeDiscount - $this->discount;
        return $discountAmount;
    }

    #[Computed]
    public function change()
    {
        if ($this->paid_amount > $this->total) {
            return $this->paid_amount - $this->total;
        }
        return 0;
    }


    public function addToCart($itemId)
    {
        $item = Item::find($itemId);

        if ($item->qty === 0) {
            Notification::make()
                ->title('Item Quantity')
                ->body('This Item Out Of The Stock')
                ->danger()
                ->send();
            return;
        }

        if (isset($this->cart[$itemId])) {
            $currentQty = $this->cart[$itemId]['qty'];
            if ($currentQty > $item->qty) {
                Notification::make()
                    ->title('Item Quantity')
                    ->body('You Can not Add More For This Item Becuse The Qty Is 0 for add')
                    ->danger()
                    ->send();
                return;
            }

            $this->cart[$itemId]['qty']++;
            return;

        } else {
            $this->cart[$itemId] = [
                'id' => $item->id,
                'name' => $item->name,
                'sku' => $item->sku,
                'price' => $item->price,
                'qty' => 1
            ];

            Notification::make()
                ->title('Item Cart')
                ->body('Item Add Successfully')
                ->success()
                ->send();
            return;
        }

    }

    public function removeFromCart($itemId)
    {
        unset($this->cart[$itemId]);
    }

    public function updateQty($itemId, $quantity)
    {
        $item = Item::find($itemId);
        $quantity = max(1, $quantity);
        if ($quantity > $item->qty) {

            $this->cart[$itemId]['qty'] = $item->qty;
            Notification::make()
                ->title('Item Quantity')
                ->body('You Can not Add More For This Item Becuse The Qty Is 0')
                ->danger()
                ->send();
            return;
            if ($quantity < 1) {
                $this->cart[$itemId]['qty'] = 1;
                return;
            }
        } else {

            $this->cart[$itemId]['qty'] = $quantity;
        }


        Notification::make()
            ->title('Cart Updated')
            ->body('Quantity updated successfully')
            ->success()
            ->send();

    }

    public function checkout()
    {
        if (empty($this->cart)) {
            Notification::make()
                ->title('Error Invoice')
                ->body('Your Cart Is Empty')
                ->danger()
                ->send();
            return;
        }

        if ($this->paid_amount < $this->total) {
            Notification::make()
                ->title('Failed Sale!')
                ->body('Paid Amount is less than total!')
                ->danger()
                ->send();
            return;
        }

        if ($this->customer_id == null || $this->payment_method_id == null) {
            Notification::make()
                ->title('Failed Sale!')
                ->body('Pleas Select Your Customer And Payment Method!')
                ->danger()
                ->send();
            return;
        }

        try {
            DB::beginTransaction();

            $sale = Sale::create([
                'payment_method_id' => $this->payment_method_id,
                'customer_id' => $this->customer_id,
                'discount' => $this->discount,
                'total' => $this->total,
                'paid_amount' => $this->paid_amount,
            ]);

            foreach ($this->cart as $item) {
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'item_id' => $item['id'],
                    'price' => $item['price'],
                    'qty' => $item['qty'],
                ]);
            }

            DB::commit();

            $this->cart = [];
            $this->search='';
            $this->customer_id = null;
            $this->payment_method_id = null;
            $this->discount = 0;
            $this->paid_amount = 0;

//            Notification::make()
//                ->title('Items Sale!')
//                ->body('Sale Oprations Done Successfully')
//                ->success()
//                ->send();
            Notification::make()
                ->title('Sale Completed')
                ->body('Do you want to print the receipt?')
                ->success()
                ->duration(10000)
                ->actions([
                    Action::make('print')
                        ->button()
                        ->label('Yes, Print Receipt')
                        ->url(route('sales.receipt', ['sale' => $sale->id]), shouldOpenInNewTab: true)
                        ->color('primary')
                        ->openUrlInNewTab(false)
                        ->extraAttributes([
                            'onclick' => 'event.preventDefault(); printReceipt(this.href);'
                        ]),
                ])
                ->send();


        } catch (\Exception $e) {
            DB::rollback();
            Notification::make()
                ->title('Failed Sale!')
                ->body('Failed to complete the sale, try again.' .$e->getMessage())
                ->danger()
                ->send();
        }
    }

    function render()
    {
        return view('livewire.pos');
    }
}
