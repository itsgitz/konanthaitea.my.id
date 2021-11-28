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
            $table->unsignedBigInteger('client_id');
            $table->decimal('total_amount', $precision = 10, $scale = 2);
            $table->enum('payment_status', ['Paid', 'Unpaid']);
            $table->enum('payment_method', ['Bank Transfer', 'E-money']);
            $table->enum('delivery_method', ['Pickup', 'Delivery']);
            $table->enum('delivery_status', ['Waiting', 'Confirmed', 'On Progress', 'Ready', 'Delivery', 'Finish', 'Failed']);
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
        Schema::dropIfExists('orders');
    }
}
