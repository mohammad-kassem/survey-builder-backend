<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model{
    use HasFactory;

    protected $fillable = [
        'survey_id',
        'question_id',
        'user_id',
        'value',
    ];

    public function user(){
        return $this->belongTo(User::class);
    }

    public function question(){
        return $this->belongTo(Question::class);
    }

}
