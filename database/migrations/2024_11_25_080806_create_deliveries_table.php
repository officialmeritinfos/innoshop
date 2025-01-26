<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();

            // Reference and user relationship
            $table->string('reference')->unique();
            $table->unsignedBigInteger('user_id'); // Use unsignedBigInteger for foreign keys
            $table->unsignedBigInteger('order_id')->nullable(); // Nullable for cases where delivery is independent of an order

            // Sender information
            $table->string('sender_name')->nullable();
            $table->string('sender_address')->nullable();
            $table->string('sender_phone')->nullable();
            $table->string('sender_email')->nullable();

            // Receiver information
            $table->string('receiver_name')->nullable();
            $table->string('receiver_address')->nullable();
            $table->string('receiver_phone')->nullable();
            $table->string('receiver_email')->nullable();

            // Delivery details
            $table->string('origin');
            $table->string('destination');
            $table->string('photo')->nullable();
            $table->string('service'); // E.g., standard, express, etc.
            $table->text('package_description')->nullable(); // Nullable for flexibility
            $table->decimal('package_fee', 10, 2)->default(0); // Default to 0 if no fee
            $table->decimal('total_weight', 10, 2)->nullable();

            // Shipment details
            $table->date('shipment_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('shipment_mode')->nullable(); // E.g., air, sea, road, rail
            $table->string('tracking_number')->unique()->nullable(); // Ensure uniqueness
            $table->enum('status', ['pending', 'in-transit', 'delivered', 'cancelled', 'on-hold'])->default('pending');

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null'); // Cascade deletes if orders are deleted
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}
