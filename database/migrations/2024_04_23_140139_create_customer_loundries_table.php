<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_loundries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('name_customer_loundry');
            $table->string('id_customer');
            $table->foreignId('spesification_loundry_id')->constrained('spesification_loundries')->cascadeOnDelete();
            $table->string('quantity_loundry');
            $table->string('result_price_loundry');
            $table->date('start_loundry_customer')->default(now());
            $table->date('end_loundry_customer');
            $table->string('phone_number_customer_loundry');
            $table->string('status_loundry')->default('pending');
            $table->string('address_customer_loundry')->default('tidak diantar')->nullable();
            $table->foreignId('payment_method_id')->nullable();
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
        Schema::dropIfExists('customer_loundries');
    }
};
