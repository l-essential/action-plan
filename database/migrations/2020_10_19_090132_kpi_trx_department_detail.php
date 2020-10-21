<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KpiTrxDepartmentDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpi_trx_department_details', function(Blueprint $table)
        {
            $table->integer('id')->primaryKey();
            $table->integer('id_detail')->primaryKey();

            $table->integer('kpi_department_id');

            $table->integer('kpi_year');
            $table->integer('kpi_month')->nullable();

            $table->string('kpi_value', 10)->nullable();

            $table->string('description')->nullable();
            $table->datetime('approve_at')->nullable();
            $table->integer('approve_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kpi_trx_department_details');
    }
}
