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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->foreignId('categories_id')
                ->constrained('categories', 'categories_id')
                ->cascadeOnDelete();
            $table->string('name');
            $table->float('price');
            $table->string('slug');
            $table->string('description');
            $table->unsignedInteger('stock_quantity', autoIncrement: false);
            $table->boolean('is_on_market')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
