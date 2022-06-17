<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration{
    public function up(){
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fname', 255);
            $table->string('lname', 255);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->integer('role_id');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('users');
    }
}
