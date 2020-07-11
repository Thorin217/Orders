<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_customer_id');
            $table->string('business_name')->nullable();
            $table->string('contact_first_name');
            $table->string('contact_last_name');
            $table->string('telephone',15)->nullable();
            $table->string('cellphone',15)->nullable();
            $table->string('address',255);
            $table->string('ncr',15)->nullable();
            $table->string('nit',15)->nullable();
            $table->string('dui',15);
            $table->string('attached',255)->nullable();
            $table->timestamps();

            $table->foreign('type_customer_id')->references('id')->on('type_customers')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
