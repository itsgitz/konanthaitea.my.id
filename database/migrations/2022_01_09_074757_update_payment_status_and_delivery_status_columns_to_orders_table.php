<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdatePaymentStatusAndDeliveryStatusColumnsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Schema::table('orders', function (Blueprint $table) { */
        /*     // */
        /*     $table->enum('payment_status', [ */
        /*         'Paid', */
        /*         'Unpaid', */
        /*         'Canceled' */
        /*     ])->change(); */

        /*     $table->enum('delivery_status', [ */
        /*         'Waiting', */
        /*         'Confirmed', */
        /*         'On Progress', */
        /*         'Ready', */
        /*         'Delivery', */
        /*         'Finish', */
        /*         'Failed', */
        /*         'Canceled' */
        /*     ])->change(); */
        /* }); */

        DB::statement("
            ALTER TABLE `orders` MODIFY COLUMN `payment_status` enum('Paid', 'Unpaid', 'Canceled')
        ");

        DB::statement("
            ALTER TABLE `orders` MODIFY COLUMN
            `delivery_status` enum('Waiting', 'Confirmed', 'On Progress', 'Ready', 'Delivery', 'Finish', 'Failed', 'Canceled')
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
