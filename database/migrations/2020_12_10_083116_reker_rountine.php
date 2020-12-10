<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RekerRountine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reker_routines', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('periode_id')->nullable();
            $table->integer('category_id')->nullable();

            $table->string('division_id', 50)->nullable();
            $table->string('department_id', 50)->nullable();
            $table->string('section_id', 50)->nullable();

            $table->text('objective');
            $table->text('target');
            $table->text('m1')->nullable();
            $table->text('m2')->nullable();
            $table->text('m3')->nullable();
            $table->text('m4')->nullable();
            $table->text('m5')->nullable();
            $table->text('m6')->nullable();
            $table->text('m7')->nullable();
            $table->text('m8')->nullable();
            $table->text('m9')->nullable();
            $table->text('m10')->nullable();
            $table->text('m11')->nullable();
            $table->text('m12')->nullable();

            $table->text('pic_department')->nullable();
            $table->text('pic')->nullable();

            $table->integer('created_by')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('reker_routine_departments', function(Blueprint $table)
        {
            $table->integer('id')->primaryKey();
            $table->integer('id_department')->primaryKey();
            
            $table->string('department_id', 50)->nullable();
        });

        Schema::create('reker_routine_pics', function(Blueprint $table)
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
        Schema::dropIfExists('reker_routines');
        Schema::dropIfExists('reker_routine_departments');
        Schema::dropIfExists('reker_routine_pics');
    }
}
