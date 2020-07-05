<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_states', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('created')->default(1);
            $table->tinyInteger('processing')->default(0);
            $table->tinyInteger('delivered')->default(0);
            $table->tinyInteger('cancelled')->default(0);
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
        Schema::dropIfExists('local_states');
    }
}
