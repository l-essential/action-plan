<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KpiPersonalJobdesk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpi_personal_jobdesks', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('division_id', 50)->nullable();
            $table->string('department_id', 50)->nullable();
            $table->string('section_id', 50)->nullable();
            $table->string('level_id', 50)->nullable();
            $table->string('job_name', 220);
            $table->integer('kpi_weight');

            $table->string('kpi_notes_1', 500)->nullable();
            $table->string('kpi_notes_2', 500)->nullable();
            $table->string('kpi_notes_3', 500)->nullable();
            $table->string('kpi_notes_4', 500)->nullable();
            $table->string('kpi_notes_5', 500)->nullable();

            $table->text('description')->nullable();
            $table->char('is_active', 1)->default('Y');
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
        Schema::drop('kpi_personal_jobdesks');
    }
}
