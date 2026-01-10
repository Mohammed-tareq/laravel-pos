<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;
    protected $fillable=[
        'name',
        'price',
        'status',
        'qty',
        'image'
    ];

    protected $guarded=['sku'];


    public function salesItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    protected static function booted()
    {
        static::creating(function ($model) {

                $model->sku = (string) Str::uuid();
        });
    }
}
