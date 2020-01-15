<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionAttemptsTable extends Migration
{
    /**
     * Run the migrations
     *
     * @return void
     */
    public function up(){
        Schema::create('question_attempts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('question_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->timestamp("attempt_begin");
            $table->mediumInteger("client_timestamp")->unsigned();
            $table->string("selected_answer");
            $table->boolean("finalized");
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('student_id')->references('id')->on('users');
        });
    }

        /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_attempts');
    }
}
