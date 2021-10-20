<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCalculatorToLarashopProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('larashop_products', function (Blueprint $table) {
            $table->string('calc_type')->nullable();
            $table->string('calc_system')->nullable();
            $table->string('calc_material')->nullable();
            $table->string('calc_resolution')->nullable();
            $table->string('calc_ports')->nullable();
            $table->string('calc_max_resolution')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('larashop_products', function (Blueprint $table) {
            $table->dropColumn('calc_type');
            $table->dropColumn('calc_system');
            $table->dropColumn('calc_material');
            $table->dropColumn('calc_resolution');
            $table->dropColumn('calc_ports');
            $table->dropColumn('calc_max_resolution');
        });
    }
}
