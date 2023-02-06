<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('user_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('productz')->nullable();
            $table->integer('price')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('kg')->nullable();
            $table->integer('reserved_qty')->nullable();
            $table->integer('product_fee')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('refno')->nullable();
            $table->string('qr')->nullable();
            $table->integer('prod_id')->nullable();
            $table->string('buy_option')->nullable();
            $table->string('status')->nullable();

            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
