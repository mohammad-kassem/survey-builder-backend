<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration{
    public function up(){
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('text', 255);
            $table->integer('survey_id');
            $table->string('type');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('questions');
    }
}
