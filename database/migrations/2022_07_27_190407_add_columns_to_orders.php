<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('orderId')->after('id')->nullable();
            $table->timestamp('deliveryDate')->after('payment_id')->nullable();
            $table->integer('cancellable')->after('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('orderId');
            $table->dropColumn('deliveryDate');
            $table->dropColumn('cancellable');
        });
    }
}
