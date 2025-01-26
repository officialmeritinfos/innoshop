<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->unsignedDecimal('price', 10, 2);
            $table->unsignedDecimal('discount_price', 10, 2)->nullable(); // Optional discounted price
            $table->unsignedBigInteger('stock')->default(0); // Number of items available
            $table->boolean('is_active')->default(true); // Status of product
            $table->unsignedBigInteger('category_id');
            $table->string('featured_image'); // URL or path to the featured image
            $table->json('images')->nullable(); // Array of additional image URLs
            $table->unsignedInteger('weight')->nullable(); // Product weight in grams
            $table->unsignedInteger('length')->nullable(); // Dimensions in cm
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->string('sku')->unique(); // Stock Keeping Unit
            $table->string('barcode')->nullable(); // Optional barcode for inventory systems
            $table->unsignedDecimal('tax', 5, 2)->nullable(); // Optional tax percentage
            $table->json('attributes')->nullable(); // For customizable attributes like size, color
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
