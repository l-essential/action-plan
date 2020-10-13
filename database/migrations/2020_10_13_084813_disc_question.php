<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DiscQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disc_questions', function(Blueprint $table){
            $table->increments('id');
            $table->string('question_1', 255);
            $table->string('question_2', 255);
            $table->string('question_3', 255);
            $table->string('question_4', 255);
            $table->integer('question_order');
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
        Schema::drop('disc_questions');
    }
}
