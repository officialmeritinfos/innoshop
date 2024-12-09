<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_bookings', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('booking_reference')->unique(); // Unique reference for the booking
            $table->enum('trip_type', ['one-way', 'round-trip', 'multi-city'])->default('one-way'); // Type of trip
            $table->date('departure_date'); // Departure date
            $table->date('return_date')->nullable(); // Return date (for round-trip)
            $table->json('multi_city_routes')->nullable(); // JSON to store multiple routes for multi-city trips
            $table->unsignedInteger('number_of_adults')->default(1); // Number of adults
            $table->unsignedInteger('number_of_children')->default(0); // Number of children
            $table->unsignedInteger('number_of_infants')->default(0); // Number of infants
            $table->enum('class', ['economy', 'business', 'first_class'])->default('economy'); // Travel class
            $table->enum('meal_preference', ['standard', 'vegetarian', 'vegan', 'halal', 'kosher'])->nullable(); // Meal preference
            $table->boolean('baggage_included')->default(false); // Indicates if baggage is included in the booking
            $table->unsignedInteger('baggage_weight')->nullable(); // Weight of baggage in kg (if included)
            $table->decimal('baggage_cost', 10, 2)->nullable(); // Cost for extra baggage
            $table->decimal('base_price', 10, 2); // Price per seat
            $table->decimal('taxes', 10, 2)->default(0); // Taxes applied to the booking
            $table->decimal('discount', 10, 2)->default(0); // Any discount applied
            $table->decimal('total_price', 10, 2); // Total price for the booking
            $table->enum('payment_status', ['pending', 'completed', 'failed'])->default('pending'); // Status of payment
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending'); // Status of booking
            $table->timestamp('cancellation_date')->nullable(); // Date of cancellation, if applicable
            $table->string('cancellation_reason')->nullable(); // Reason for cancellation
            $table->json('additional_services')->nullable(); // JSON for additional services like WiFi, lounge access
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flight_bookings');
    }
}
