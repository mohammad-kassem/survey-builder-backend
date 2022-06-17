<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'survey_id',
        'type',
    ];

    
    public function answers(){
    return $this->hasMany(UserAnswer::class);
    }

    
    public function options(){
        return $this->hasMany(AnswerOption::class);
    }

    public function survey(){
        return $this->belongsTo(Survey::class);
    }

}
