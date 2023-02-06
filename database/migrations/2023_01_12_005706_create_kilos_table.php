<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKilosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kilos', function (Blueprint $table) {
            $table->id();
            $table->string('prod_name')->nullable();
            $table->integer('kg')->nullable();
            $table->integer("store_quantity")->nullable();
            $table->integer("warehouse_quantity")->nullable();
            $table->integer("price")->nullable();
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
        Schema::dropIfExists('kilos');
    }
}
