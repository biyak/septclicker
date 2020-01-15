<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizAttemptsTable extends Migration
{
    /**
     * Run the migrations
     * 
     * @return void
     */
    public function up(){
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('quiz_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->timestamp("attempt_begin");
            $table->boolean("finalized");

            $table->foreign('quiz_id')->references('id')->on('quizzes');
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
        Schema::dropIfExists('quiz_attempts');
    }
}
