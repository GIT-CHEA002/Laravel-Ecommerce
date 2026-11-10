<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Override;

class OrderProduct extends Model
{
    //
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $primaryKey = 'order_product_id';
    protected  $guarded = ['line_total'];
    // case 
    protected $casts = ['unit_price' => 'decimal:2'];

    #[Override]
    protected static function booted()
    {
        parent::booted();
        // before insert or update : calculated the line total 
        static::saving(function (OrderProduct $item) {
            $item->line_total = $item->calculateLineTotal();
        });
        static::saved(function (OrderProduct $item) {
            $order = $item->order()->first();
            if ($order instanceof Order) {
                $order->reCalculateTotalAmount();
            }
        });
        static::deleted(function (OrderProduct $item) {
            $order = $item->order()->first();
            if ($order instanceof Order) {
                $order->reCalculateTotalAmount();
            }
        });
    }
    // relationship 
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    // service methods : 
    public function calculateLineTotal()
    {
        $unit_price = $this->unit_price;
        $quantity = $this->quantity;
        return $unit_price * $quantity;
    }
}
