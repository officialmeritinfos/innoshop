<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('status')->default('pending'); // pending, processing, shipped, completed, canceled, refunded
            $table->unsignedDecimal('total_price', 10, 2);
            $table->unsignedDecimal('tax_amount', 10, 2)->default(0); // Tax calculated for the order
            $table->unsignedDecimal('shipping_fee', 10, 2)->default(0); // Shipping cost
            $table->text('shipping_address');
            $table->text('billing_address')->nullable();
            $table->string('payment_method'); // e.g., PayPal, Stripe, bank transfer
            $table->string('payment_status')->default('unpaid'); // paid, unpaid, failed, refunded
            $table->string('shipping_method')->nullable(); // e.g., FedEx, DHL
            $table->timestamp('shipped_at')->nullable(); // When the order was shipped
            $table->timestamp('delivered_at')->nullable(); // When the order was delivered
            $table->json('notes')->nullable(); // Customer or admin notes
            $table->string('tracking_number')->nullable(); // Tracking number for shipment
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
