<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KpiFinalValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kpi_trx_departments', function(Blueprint $table)
        {
            $table->string('kpi_final_value', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kpi_trx_departments', function(Blueprint $table)
        {
            $table->dropColumn('kpi_final_value', 50);
        });
    }
}
