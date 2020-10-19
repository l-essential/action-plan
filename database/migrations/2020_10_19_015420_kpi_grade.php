<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KpiGrade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpi_grades', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('kpi_grade', 15);
            $table->integer('kpi_grade_from');
            $table->integer('kpi_grade_until');

            $table->text('description')->nullable();
            $table->char('is_active', 1)->default('Y');

            $table->integer('kpi_order');
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
        Schema::drop('kpi_grades');
    }
}
