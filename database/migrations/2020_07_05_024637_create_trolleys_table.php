<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrolleysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trolleys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventory_id');
            $table->unsignedBigInteger('order_id');
            $table->integer('quantity');
            $table->decimal('discount');
            $table->decimal('unit_total');
            $table->timestamps();

            $table->foreign('inventory_id')->references('id')->on('inventories')->onUpdate('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trolleys');
    }
}
