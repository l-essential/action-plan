<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KpiPercentaseLevel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpi_percentase_levels', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('level_id', 15);
            $table->integer('quantitative_value');
            $table->integer('qualitative_value');

            $table->text('description')->nullable();
            $table->char('is_active', 1)->default('Y');

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
        Schema::drop('kpi_percentase_levels');
    }
}
