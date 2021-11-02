<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Schema::create('invoices', function (Blueprint $table) { */
        /*     $table->id(); */
        /*     $table->unsignedBigInteger('client_id'); */
        /*     $table->unsignedBigInteger('menu_id'); */
        /*     $table->integer('quantity'); */
        /*     $table->integer('total_amount'); */
        /*     $table->enum('payment_status', ['Paid', 'Unpaid']); */
        /*     $table->enum('order_status', ['On Progress', 'Finish']); */
        /*     $table->timestamps(); */
        /* }); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
