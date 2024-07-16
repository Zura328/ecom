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
        Schema::table('users', function (Blueprint $table) {
            $table->string('prefix')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone_number')->nullable();
        });
    }



    /**
     * Reverse the migrations.
     */

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['prefix', 'first_name', 'middle_name', 'last_name', 'gender', 'date_of_birth', 'phone_number']);
        });
    }
};
