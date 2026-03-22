<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Import the Review model
use App\Models\Review;

/**
 * @mixin IdeHelperProduct
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
        'stock',
        'compatibility',
        'type',
        'benchmark_score',
    ];

    /**
     * Cast attributes to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'compatibility' => 'array',
        'benchmark_score' => 'integer',
    ];

    /**
     * Define the relationship to Reviews.
     * This allows Product::with('reviews') to function in the controller.
     */
    public function reviews()
    {
        // One product has many reviews
        return $this->hasMany(Review::class);
    }
}
