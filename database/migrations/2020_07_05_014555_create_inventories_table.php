<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('image',255)->nullable();
            $table->integer('quantity_stock')->default(0);
            $table->decimal('unit_price',8,2);
            $table->decimal('percent_commission')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
