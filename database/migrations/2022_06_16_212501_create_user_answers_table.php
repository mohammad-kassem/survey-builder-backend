<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAnswersTable extends Migration{
    public function up(){
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('question_id');
            $table->integer('user_id');
            $table->string('value', 255);
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('user_answers');
    }
}
