<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('shipping', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // Foreign key for the order
            $table->unsignedBigInteger('delivery_guy_id'); // Foreign key for the delivery person (user)
            $table->string('payment_mode'); // Mode of payment
            $table->text('shipping_address'); // Shipping address
            $table->string('status'); // Shipping status
            $table->timestamps();

            // Define foreign keys
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('delivery_guy_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipping');
    }
};
