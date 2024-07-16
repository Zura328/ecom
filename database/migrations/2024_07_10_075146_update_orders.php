<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    

     public function down()
     {
     }
    public function up()
    {
        Schema::dropIfExists('orders');
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); // Foreign key for the customer (user)
            $table->unsignedBigInteger('product_id'); // Foreign key for the product
            $table->integer('quantity')->unsigned();
            $table->decimal('total_price', 10, 2);
            $table->string('status'); // Status of the order (e.g., pending, checked out)
            $table->string('size'); // Size of the product ordered (e.g., small, medium, large, xlarge)
            $table->timestamps();

            // Define foreign keys
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }
};
