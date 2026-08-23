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
            $table->id('order_id');
            $table->foreignId('user_id')
                ->constrained('users', 'user_id')
                ->cascadeOnDelete();
            $table->string('order_number')->unique();
            $table->float('total_amount');
            $table->enum('status', ['shipping', 'pending', 'arrived'])->default('pending');
            $table->string('shipping_address')->nullable();
            $table->enum('payment_methods', ['ABA', 'ACLEDA', 'BAKONG', 'CREDIT CARD']);
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
