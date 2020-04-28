<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->Integer('timelimit')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('quiz_name');
            $table->Integer('quiz_weight');
            $table->Integer('active')->default(0);
            $table->index('user_id');
            $table->Integer('deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
}
