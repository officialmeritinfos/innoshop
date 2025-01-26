<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Cash Transfer", "Crypto", "Gift Card"
            $table->string('description')->nullable(); // Short description of the payment method
            $table->enum('type', ['cash_transfer', 'crypto', 'gift_card', 'other']);
            $table->boolean('is_active')->default(true); // Status: active or inactive
            $table->timestamps();
        });
        Schema::create('crypto_wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_method_id'); // Foreign key to payment_methods
            $table->string('crypto_name'); // e.g., "Bitcoin", "Ethereum"
            $table->string('network_name'); // e.g., "Ethereum Mainnet", "Binance Smart Chain"
            $table->string('wallet_address'); // Admin's wallet address for this cryptocurrency
            $table->string('qr_code_path')->nullable(); // Optional QR code for the wallet
            $table->boolean('is_active')->default(true); // Status of the wallet
            $table->timestamps();

            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
        });
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Merchant name (e.g., "Amazon", "Steam")
            $table->string('description')->nullable(); // Optional description
            $table->boolean('is_active')->default(true); // Status of the merchant
            $table->timestamps();
        });
        Schema::create('merchant_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merchant_id'); // Foreign key to merchants
            $table->unsignedBigInteger('payment_method_id'); // Foreign key to payment_methods
            $table->timestamps();

            $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
        });
        Schema::create('gift_card_uploads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_method_id'); // Foreign key to payment_methods
            $table->unsignedBigInteger('merchant_id'); // Foreign key to merchants
            $table->unsignedBigInteger('user_id'); // User who uploaded the gift card
            $table->json('uploaded_images'); // Paths to the uploaded images
            $table->timestamps();

            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
            $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::create('cash_transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_method_id'); // Foreign key to payment_methods
            $table->unsignedBigInteger('user_id'); // User who made the transfer
            $table->string('bank_name'); // Name of the sender's bank
            $table->string('account_name'); // Sender's account name
            $table->string('account_number'); // Sender's account number
            $table->string('proof_of_payment'); // Path to the uploaded receipt or proof of payment
            $table->timestamps();

            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
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
        Schema::dropIfExists('payment_methods');
    }
}
