<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KpiTrxPersonal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('kpi_trx_personals');

        Schema::create('kpi_trx_personals', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('division_id', 50)->nullable();
            $table->string('department_id', 50)->nullable();
            $table->string('section_id', 50)->nullable();
            $table->string('level_id', 50)->nullable();
            $table->integer('kpi_year_from');
            $table->integer('kpi_month_from')->nullable();
            $table->integer('kpi_year_until');
            $table->integer('kpi_month_until')->nullable();

            $table->string('kpi_status', 50)->nullable();
            $table->integer('created_by');
            $table->text('description')->nullable();
            $table->char('is_active', 1)->default('Y');
            $table->timestamps();
        });

        Schema::create('kpi_trx_personal_jobdesks', function(Blueprint $table)
        {
            $table->integer('id');
            $table->integer('id_detail');

            $table->string('nik', 50)->nullable();

            $table->integer('job_id')->nullable();
            $table->text('job_name')->nullable();
            $table->float('kpi_weight')->nullable();
            $table->string('is_job_custom', 1)->nullable();
            $table->text('kpi_value_notes')->nullable();
            $table->integer('kpi_year');
            $table->integer('kpi_month')->nullable();
            $table->string('kpi_value', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kpi_trx_personals');
        Schema::dropIfExists('kpi_trx_personal_jobdesks');
    }
}
