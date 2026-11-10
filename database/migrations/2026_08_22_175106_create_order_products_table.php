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
        Schema::create('order_products', function (Blueprint $table) {
            // relationship and key 
            $table->id('order_products_id');
            $table->foreignId('order_id')
                ->constrained('orders', 'order_id')
                ->cascadeOnDelete();
            $table->foreignId('product_id')
                ->constrained('products', 'product_id')
                ->cascadeOnDelete();

            // product info 
            $table->string('product_name');
            $table->unsignedInteger('product_sku')->default(0);
            $table->decimal('unit_price', 12, 2)->default(0);
            $table->unsignedInteger('quantity')->default(1);
            // sum of all unit
            $table->decimal('line_total', 12, 2)->default(0);
            $table->timestamps();

            // set the index of the product id (to prevent duplicated product id in order_products , just update the quantity)
            $table->index('product_id');
            $table->index('order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
