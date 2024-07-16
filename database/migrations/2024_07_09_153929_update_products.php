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
         Schema::dropIfExists('products');
     }
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->unsigned()->default(0);
            $table->string('image')->nullable();
            $table->string('gender')->nullable();
            $table->integer('small')->unsigned()->default(0); // Number of small items in stock
            $table->integer('medium')->unsigned()->default(0); // Number of medium items in stock
            $table->integer('large')->unsigned()->default(0); // Number of large items in stock
            $table->integer('xlarge')->unsigned()->default(0); // Number of extra-large items in stock
            $table->string('season')->nullable();
            $table->string('category')->nullable();
            $table->timestamps();
        });
    }
};
