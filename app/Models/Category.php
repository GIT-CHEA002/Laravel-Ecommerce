<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Override;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    protected $primaryKey = 'categories_id';
    protected $guarded = [];
    // public function parent(): BelongsTo
    // {
    //     return $this->belongsTo(Category::class, 'parent_categories_id');
    // }
    // public function children(): HasMany
    // {
    //     return $this->hasMany(Category::class, 'parent_categories_id');
    // }
    // public function childrenRecursive(): HasMany
    // {
    //     return $this->children()->with('childrenRecursive');
    // }
    #[Override]
    protected static function booted()
    {
        parent::booted();
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'categories_id', 'categories_id');
    }
    // public function syncProductCount(): void
    // {
    //     $this->forceFill([
    //         'product_attached' => $this->products()->count(),
    //     ])->saveQuietly();
    // }
}
