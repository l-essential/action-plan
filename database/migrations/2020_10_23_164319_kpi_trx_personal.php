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
        Schema::create('kpi_trx_personals', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('created_by');
            $table->string('nik', 50)->nullable();

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
        Schema::drop('kpi_trx_personals');
    }
}
