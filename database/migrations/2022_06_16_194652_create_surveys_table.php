<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration{
    public function up(){
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('surveys');
    }
}
