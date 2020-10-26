<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KetNilaiKpiDepartment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kpi_departments', function(Blueprint $table)
        {
            $table->text('kpi_notes_1')->nullable();
            $table->text('kpi_notes_2')->nullable();
            $table->text('kpi_notes_3')->nullable();
            $table->text('kpi_notes_4')->nullable();
            $table->text('kpi_notes_5')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kpi_departments', function(Blueprint $table)
        {
            $table->dropColumn('kpi_notes_1');
            $table->dropColumn('kpi_notes_2');
            $table->dropColumn('kpi_notes_3');
            $table->dropColumn('kpi_notes_4');
            $table->dropColumn('kpi_notes_5');
        });
    }
}
