<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('payment_type_id');
            $table->unsignedBigInteger('delivery_type_id');
            $table->unsignedBigInteger('orderable_id')->nullable();
            $table->string('orderable_type')->nullable();
            $table->decimal('total_order')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('payment_type_id')->references('id')->on('payment_types');
            $table->foreign('delivery_type_id')->references('id')->on('delivery_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
