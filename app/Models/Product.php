<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $primaryKey = 'product_id';
    public function category(): BelongsTo
    {
        return $this->belongsTo(Categories::class, 'categories_id', 'categories_id');
    }
    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'product_id');
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'product_id', 'product_id');
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class, 'product_id', 'product_id');
    }
}
