<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserAnswersTable extends Migration{
    public function up(){
        Schema::table('user_answers', function (Blueprint $table) {
            $table->dropColumn('survey_id');
        });
    }
}
