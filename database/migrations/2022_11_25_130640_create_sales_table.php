<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('products')->nullable();
            $table->string('prod_img')->nullable();
            $table->integer('reserved_qty')->nullable();
            $table->integer('price')->nullable();
            $table->integer('product_fee')->nullable();
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
        Schema::dropIfExists('sales');
    }
}
