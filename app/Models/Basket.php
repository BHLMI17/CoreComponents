<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $fillable = [
    'user_id',
    'product_id',
    'name',
    'price',
    'quantity',
    'image',
];

    /**
     * The product linked with the basket item
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    
}
