<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();

            $table->string('receiptfor')->nullable();
            $table->string('recipient')->nullable();
            $table->string('prod_name')->nullable();
            $table->integer('prod_qty')->nullable();
            $table->integer('paid_fee')->nullable();
            $table->integer('total_fee')->nullable();
            $table->string('prod_img')->nullable();
            $table->string('proof')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();

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
        Schema::dropIfExists('receipts');
    }
}
