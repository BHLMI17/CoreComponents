<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'name',
        'price',
        'image',
        'quantity',
    ];

    protected static function booted()
{
    static::saving(function ($item) {
        if ($item->product_id && empty($item->name)) {
            $item->name = $item->product->name;
        }
    });
}


    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}