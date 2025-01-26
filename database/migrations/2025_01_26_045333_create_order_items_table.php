<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->string('product_name'); // Capture product name at the time of purchase
            $table->unsignedDecimal('price', 10, 2); // Price of product at the time of purchase
            $table->unsignedDecimal('discount_price', 10, 2)->nullable(); // Discounted price at the time of purchase
            $table->unsignedInteger('quantity')->default(1);
            $table->unsignedDecimal('tax', 5, 2)->nullable(); // Tax percentage for this product
            $table->json('attributes')->nullable(); // e.g., selected size, color
            $table->text('notes')->nullable(); // Additional notes for the item
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
