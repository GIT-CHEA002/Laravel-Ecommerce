<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Override;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $primaryKey = 'order_id';
    protected $fillable = ['order_number'];
    #[Override]
    protected static function booted(): void
    {
        static::created(function (Order $order) {
            $order->forceFill([
                'order_number' => 'ORD-' . str_pad($order->order_id, 3, '0', STR_PAD_LEFT),
            ])->saveQuietly();
        });
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function orderProduct(): HasMany
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'order_id');
    }
}
