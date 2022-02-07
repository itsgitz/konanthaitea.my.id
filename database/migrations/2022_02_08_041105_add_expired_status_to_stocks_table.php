<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddExpiredStatusToStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Schema::table('stocks', function (Blueprint $table) { */
        /*     // */
        /* }); */

        DB::statement("
            ALTER TABLE `stocks` MODIFY COLUMN `status` enum('Available','Not Available', 'Limited', 'Expired')
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stocks', function (Blueprint $table) {
            //
        });
    }
}
