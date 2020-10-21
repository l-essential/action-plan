<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KpiTrxDepartment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpi_trx_departments', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('division_id', 50)->nullable();
            $table->string('department_id', 50)->nullable();
            $table->string('section_id', 50)->nullable();
            $table->integer('kpi_year_from');
            $table->integer('kpi_month_from')->nullable();
            $table->integer('kpi_year_until');
            $table->integer('kpi_month_until')->nullable();

            $table->string('kpi_status', 150)->nullable();

            $table->string('description')->nullable();
            $table->string('is_active', 1)->default('Y');
            $table->integer('created_by');
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
        Schema::drop('kpi_trx_departments');
    }
}
