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
        parent::booted();
        // when create the order-number : ORD + order_id 
        static::created(function (Order $order) {
            $order->forceFill([
                'order_number' => 'ORD-' . str_pad($order->order_id, 3, '0', STR_PAD_LEFT),
            ])->saveQuietly();
        });
        // 
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function orderProduct(): HasMany
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'order_id');
    }
    public function calculateSubTotal(): float
    {
        $subtotal = $this->orderProduct()->sum('line_total');
        return round((float) $subtotal, 2); // use 2 precision only 
    }
    public function calculateTotalAmount(): float
    {
        $subtotal = (float) $this->subtotal;
        $dicount_amount = (float) $this->discount_amount;
        $shipping_fee = (float) $this->shipping_fee;
        $tax_amount = (float) $this->tax_amount;

        $totalAmount = $subtotal + $shipping_fee + $tax_amount - $dicount_amount;
        return round((float) $totalAmount, 2);
    }
    public  function reCalculateTotalAmount(): void
    {
        $this->subtotal = $this->calculateSubTotal();
        $this->total_amount = $this->calculateTotalAmount();
        $this->saveQuietly();
    }
}
