<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id'); //foreign key for users
            $table->string('quiz_id')->nullable(); // might have no active quizzes
            $table->string('title');
            $table->text('description');
            $table->timestamps();

            //For quicker queries, 
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations. 
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_lists');
    }
}
