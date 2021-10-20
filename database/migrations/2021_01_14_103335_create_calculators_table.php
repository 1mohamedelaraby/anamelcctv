<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalculatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained()->CascadeOnDelete();
            $table->boolean('paid')->default(0);
            $table->string('payment_type')->default('credit');
            $table->string('status')->default('جاري التحضير');
            $table->integer('price')->default(0);
            $table->integer('shipping_cost')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('payment_fee')->default('0');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('address', 1000)->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
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
        Schema::dropIfExists('calculators');
    }
}
