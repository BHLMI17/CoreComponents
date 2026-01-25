<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'product_id',
        'quantity',
        'price_at_time', // optional
    ];

    /**
     * Relationship: Basket item belongs to a product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relationship: Basket item belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope: Get basket items for the current user or guest session
     */
    public function scopeForCurrent($query)
    {
        return auth()->check()
            ? $query->where('user_id', auth()->id())
            : $query->where('session_id', session()->getId());
    }

    /**
     * Accessor: Calculate line total (quantity × price)
     */
    public function getLineTotalAttribute()
    {
        $price = $this->price_at_time ?? $this->product->price;
        return $this->quantity * $price;
    }
}