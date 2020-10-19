<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KpiDepartment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpi_departments', function(Blueprint $table)
        {
            $table->increments('id');

            $table->text('kpi_name');

            $table->string('division_id', 50)->nullable();
            $table->string('department_id', 50)->nullable();
            $table->string('section_id', 50)->nullable();

            $table->float('kpi_percentage');
            $table->float('kpi_target');

            $table->string('description')->nullable();
            $table->string('is_active', 1)->default('Y');
            $table->integer('kpi_order')->nullable();
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
        Schema::drop('kpi_departments');
    }
}
