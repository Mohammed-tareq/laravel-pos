<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\Sale;

class SaleItem extends Model
{
    /** @use HasFactory<\Database\Factories\SaleItemFactory> */
    use HasFactory;
    protected $fillable=[
        'sale_id',
        'item_id',
        'price',
        'qty'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
