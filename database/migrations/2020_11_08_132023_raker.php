<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Raker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reker_periodes', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('periode_from', 10)->nullable();
            $table->string('periode_until', 10)->nullable();

            $table->integer('created_by')->nullable();
            $table->text('description')->nullable();
            $table->char('is_active', 1)->default('Y');
            $table->char('is_closed', 1)->default('Y');
            $table->timestamps();
        });

        Schema::create('rekers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('periode_id');
            $table->integer('category_id');

            $table->string('division_id', 50)->nullable();
            $table->string('department_id', 50)->nullable();
            $table->string('section_id', 50)->nullable();

            $table->text('objective');
            $table->text('target');
            $table->text('q1')->nullable();
            $table->text('q2')->nullable();
            $table->text('q3')->nullable();
            $table->text('q4')->nullable();

            $table->text('pic_department');
            $table->text('pic');

            $table->integer('created_by')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('reker_departments', function(Blueprint $table)
        {
            $table->integer('id')->primaryKey();
            $table->integer('id_department')->primaryKey();
            
            $table->string('department_id', 50)->nullable();
        });

        Schema::create('reker_pics', function(Blueprint $table)
        {
            $table->integer('id')->primaryKey();
            $table->integer('id_pic')->primaryKey();
            
            $table->string('nik', 24);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reker_periode');
        Schema::drop('reker');
        Schema::drop('reker_pic');
        Schema::drop('reker_department');
    }
}
