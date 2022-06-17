<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerOptionsTable extends Migration{
    public function up()
    {
        Schema::create('answer_options', function (Blueprint $table) {
            $table->id();
            $table->string('option', 255);
            $table->integer('question_id');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('answer_options');
    }
}
