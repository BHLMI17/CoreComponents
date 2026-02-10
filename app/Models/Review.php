<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * These allow your "Write a Review" modal to save data to the database.
     */
    protected $fillable = [
        'product_id',
        'user_name',
        'rating',
        'title',
        'comment'
    ];

    /**
     * Link back to the Product (Inverse Relationship).
     * This allows a review to know which product it belongs to.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}