<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            // relation and key 
            $table->id('order_id');
            $table->foreignId('user_id')
                ->constrained('users', 'user_id')
                ->cascadeOnDelete();
            $table->string('order_number')->unique()->nullable();

            // Money information 
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('shipping_fee', 12, 2)->default(0);
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->char('currency', 3)->default('USD');

            // order life cyclye
            $table->enum(
                'status',
                ['pending', 'processing', 'shipping', 'delivered', 'cancelled', 'refuned']
            )->nullable()->default('pending');

            // payment methods : 
            $table->enum('payment_methods', ['ABA', 'ACLEDA', 'BAKONG', 'CREDIT CARD', 'CODE']);
            $table->enum('payment_status', ['unpaid', 'paid', 'failed', 'refuned'])->default('unpaid');
            $table->string('payment_reference')->nullable(); // transaction id or return id when purchase

            // Shipping Snapshort 
            $table->string('shipping_name')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->text('shipping_address')->nullable();
            $table->text('shipping_note')->nullable();

            // Timestamp for order state 
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('shipping_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
