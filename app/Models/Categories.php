<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categories extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriesFactory> */
    use HasFactory;
    protected $primaryKey = 'categories_id';
    protected $guarded = [];
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Categories::class, 'parent_categories_id');
    }
    public function children(): HasMany
    {
        return $this->hasMany(Categories::class, 'parent_categories_id');
    }
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'categories_id', 'categories_id');
    }
}
