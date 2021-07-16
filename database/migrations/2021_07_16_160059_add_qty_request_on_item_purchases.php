<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQtyRequestOnItemPurchases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items_purchases', function (Blueprint $table) {
            $table->integer('qtyRequested')->default(0);
            $table->integer('qtyReturns')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items_purchases', function (Blueprint $table) {
            $table->dropColumn('qtyRequested');
            $table->dropColumn('qtyReturns');
        });
    }
}