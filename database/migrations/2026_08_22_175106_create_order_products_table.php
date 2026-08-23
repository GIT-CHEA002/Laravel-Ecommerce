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
            $table->id('order_products_id');
            $table->foreignId('order_id')
                ->constrained('orders', 'order_id')
                ->cascadeOnDelete();
            $table->foreignId('product_id')
                ->constrained('products', 'product_id')
                ->cascadeOnDelete();
            $table->float('price');
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamps();
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
